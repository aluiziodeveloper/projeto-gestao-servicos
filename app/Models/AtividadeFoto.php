<?php
declare(strict_types=1);

namespace GestaoServicos\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class AtividadeFoto extends Model
{
    const BASE_PATH = 'app/public';
    const DIR_ATIVIDADES = 'atividades';
    const ATIVIDADES_PATH = self::BASE_PATH . '/' . self::DIR_ATIVIDADES;

    protected $fillable = [
        'file_name',
        'atividade_id'
    ];

    public static function photosPath($atividadeId)
    {
        $path = self::ATIVIDADES_PATH;
        return storage_path("{$path}/{$atividadeId}");
    }

    public static function createWithPhotosFiles(int $atividadeId, array $files): Collection
    {
        try {
            self::uploadFiles($atividadeId, $files);
            \DB::beginTransaction();
            $photos = self::createPhotosModels($atividadeId, $files);
            \DB::commit();
            return new Collection($photos);
        } catch (\Exception $e) {
            self::deleteFiles($atividadeId, $files);
            \DB::rollBack();
            throw $e;
        }
    }

    public function updateWithPhoto(UploadedFile $file): AtividadeFoto
    {
        try {
            self::uploadFiles($this->atividade_id, [$file]);
            \DB::beginTransaction();
            $this->deletePhoto($this->file_name);
            $this->file_name = $file->hashName();
            $this->save();
            \DB::commit();
            return $this;
        } catch (\Exception $e) {
            self::deleteFiles($this->atividade_id, [$file]);
            \DB::rollBack();
            throw $e;
        }
    }

    public function deleteWithPhoto(): bool
    {
        try {
            \DB::beginTransaction();
            $this->deletePhoto($this->file_name);
            $result = $this->delete();
            \DB::commit();
            return $result;
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    private function deletePhoto($fileName)
    {
        $dir = self::photosDir($this->atividade_id);
        \Storage::disk('public')->delete("{$dir}/{$fileName}");
    }

    private static function deleteFiles(int $atividadeId, array $files)
    {
        /** @var UploadedFile $file */
        foreach ($files as $file) {
            $path = self::photosPath($atividadeId);
            $photoPath = "{$path}/{$file->hashName()}";
            if (file_exists($photoPath)) {
                \File::delete($photoPath);
            }
        }
    }

    public static function uploadFiles(int $atividadeId, array $files)
    {
        $dir = self::photosDir($atividadeId);
        /** @var UploadedFile $file */
        foreach ($files as $file) {
            $file->store($dir, ['disk' => 'public']);
        }
    }

    private static function createPhotosModels(int $atividadeId, array $files): array
    {
        $photos = [];
        /** @var UploadedFile $file */
        foreach ($files as $file) {
            $photos[] = self::create([
                'file_name' => $file->hashName(),
                'atividade_id' => $atividadeId
            ]);
        }
        return $photos;
    }

    public function getPhotoUrlAttribute()
    {
        $path = self::photosDir($this->atividade_id);
        return asset("storage/{$path}/{$this->file_name}");
    }

    public static function photosDir($atividadeId)
    {
        $dir = self::DIR_ATIVIDADES;
        return "{$dir}/{$atividadeId}";
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class)->withTrashed();
    }
}
