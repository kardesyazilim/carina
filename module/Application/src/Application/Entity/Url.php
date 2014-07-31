<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Url
 *
 * @ORM\Table(name="core_url")
 * @ORM\Entity
 */
class Url implements InputFilterAwareInterface
{
	/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    
    /**
     * @var string
     *
     * @ORM\Column(name="core_url_key", type="string", length=100, unique=true, nullable=false)
     */
    private $name;//core_url_key varchar 100 uniq

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    
    private $status;//status integer 1 

    /**
     * @var datetime
     *
     * @ORM\Column(name="create_time", type="datetime")
     */
    private $created_at;//create_time timestamp
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="update_time", type="datetime")
     */

    private $modified_at;//update_time timestamp
    

    /**
    * Get Id
    *
    * @param integer
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Set name
    *
    * @param string $name
    * @return Url
    */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }



    
    /**
     * Now we tell doctrine that before we persist or update we call the updatedTimestamps() function.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setModifiedAt(new \DateTime(date('Y-m-d H:i:s')));

        if($this->getCreatedAt() == null)
        {
            $this->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
        }
    }

    protected $inputFilter;

}