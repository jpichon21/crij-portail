<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Representation;

use Pagerfanta\Pagerfanta;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;

class Sections
{
    /**
     * @Type("array<AppBundle\Entity\Section>")
     * @Serializer\Groups({"Section:list", "Section:details", "Article:list"})
     */
    private $data;

    /**
    * @Serializer\Groups({"Section:list", "Section:details", "Article:list"})
    */
    private $meta;

    public function __construct(Pagerfanta $data)
    {
        $this->data  = $data->getCurrentPageResults();

        $this->addMeta('limit', $data->getMaxPerPage());
        $this->addMeta('current_items', count($data->getCurrentPageResults()));
        $this->addMeta('total_items', $data->getNbResults());
        $this->addMeta('offset', $data->getCurrentPageOffsetStart());
        $this->addMeta('page', $data->getCurrentPage());
    }

    private function addMeta($name, $value)
    {
        if (isset($this->meta[$name])) {
            throw new \LogicException(sprintf('This meta already exists. 
            You are trying to override this meta, use the setMeta method instead for the %s meta.', $name));
        }

        $this->setMeta($name, $value);
    }

    private function setMeta($name, $value)
    {
        $this->meta[$name] = $value;
    }
}
