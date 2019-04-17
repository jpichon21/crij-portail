<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Media Admin class
 */
final class MediaAdmin extends AbstractAdmin
{
    /**
     * Hook prePersist event to set media in a child form.
     *
     * @param Media $media
     *
     */
    public function prePersist($media)
    {
        $this->manageFileUpload($media);
    }

    /**
     *  Hook prePersist event to set media in a child form.
     *
     * @param Media $media
     *
     */
    public function preUpdate($media)
    {
        $this->manageFileUpload($media);
    }

    /**
     * Configure admin form.
     *
     * @param FormMapper $formMapper
     *
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('file', FileType::class, [
                'required' => true,
            ]);
    }

    /**
     * Configure filter used on list view.
     *
     * @param DatagridMapper $datagridMapper
     *
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, [
                'label' => 'Nom du fichier',
            ]);
    }

    /**
     * Configure field dysplay on list view.
     *
     * @param ListMapper $listMapper
     *
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, [
                'label' => 'Nom du fichier',
            ]);
    }

    /**
     * Used by sonata bundle to upload file.
     *
     * @param Media $media
     *
     */
    private function manageFileUpload($media)
    {
        $uploadedFile = $this->getForm()->get('file')->getData();

        $uploadableManager = $this->getConfigurationPool()
                                ->getContainer()
                                ->get('stof_doctrine_extensions.uploadable.manager');

        $media->file = $uploadedFile;

        if ($media->file instanceof UploadedFile) {
            $uploadableManager->markEntityToUpload($media, $media->file);
        }
    }
}
