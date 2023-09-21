<?php

namespace App\Repositories\Section;

/**
 *
 */
interface SectionInterface
{


    public function createSection(array $data);

    /**
     * @return mixed
     */
    public function getAll(string $parentId = null);

    /**
     * @param $id
     * @return mixed
     */
    public function findSection($id);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteSection($id);

    public function updateSection($data);

    public function breadCrumb(string $parentId = null);
}
