<?php
declare(strict_types=1);

use GestaoServicos\Models\Atividade;
use GestaoServicos\Models\AtividadeFoto;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class AtividadeFotosTableSeeder extends Seeder
{
    /**
     * @var Collection
     */
    private $allFakerPhotos;

    private $fakerPhotosPath = 'app/faker/atividade_fotos';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->allFakerPhotos = $this->getFakerPhotos();
        $atividades = Atividade::all();
        $this->deleteAllPhotosInAtividadesPath();
        $self = $this;
        $atividades->each(function ($atividade) use ($self) {
            $self->createPhotoDir($atividade);
            $self->createPhotosModels($atividade);
        });
    }

    private function getFakerPhotos(): Collection
    {
        $path = storage_path($this->fakerPhotosPath);
        return collect(\File::allFiles($path));
    }

    private function deleteAllPhotosInAtividadesPath()
    {
        $path = AtividadeFoto::ATIVIDADES_PATH;
        \File::deleteDirectory(storage_path($path), true);
    }

    private function createPhotoDir(Atividade $atividade)
    {
        $path = AtividadeFoto::photosPath($atividade->id);
        \File::makeDirectory($path, 0777, true);
    }

    private function createPhotosModels(Atividade $atividade)
    {
        foreach (range(1, 5) as $value) {
            $this->createPhotoModel($atividade);
        }
    }

    private function createPhotoModel(Atividade $atividade)
    {
        $photo = AtividadeFoto::create([
            'atividade_id' => $atividade->id,
            'file_name' => 'imagem.jpg'
        ]);
        $this->generatePhoto($photo);
    }

    private function generatePhoto(AtividadeFoto $photo)
    {
        $photo->file_name = $this->uploadPhoto($photo->atividade_id);
        $photo->save();
    }

    private function uploadPhoto($atividadeId): string
    {
        /** @var SplFileInfo $photoFile */
        $photoFile = $this->allFakerPhotos->random();
        $uploadFile = new UploadedFile(
            $photoFile->getRealPath(),
            str_random(16) . '.' . $photoFile->getExtension()
        );
        AtividadeFoto::uploadFiles($atividadeId, [$uploadFile]);
        return $uploadFile->hashName();
    }
}
