<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


/**
 * Type
 *
 * @ORM\Table(name="core_type")
 * @ORM\Entity
 */
class Type implements InputFilterAwareInterface
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
     * @ORM\Column(name="core_type_name", type="string", length=100, unique=true, nullable=false)
     */
    private $name;//core_type_name varchar 100 uniq

    /**
     * @var string
     * @ORM\Column(name="core_type_value", type="string", length=100, unique=false, nullable=false)
     */

    private $value;

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



    public function getId()
    {
        return $this->id;
    }
    /**
    * Get name
    *
    * @return string
    */
    public function getName(){
    	return $this->name;
    }
    /**
    * Set name
    *
    * @param string $name
    * @return Type
    */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    
    /**
    * Get value
    *
    * @return string
    */
    public function getValue(){
    	return $this->value;
    }

    /**
    * Set value
    *
    * @param string $value
    * @return Type
    */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
    /**
     * Get Status
     * 
     * @return integer
     */
    public function getStatus(){
    	return $this->status;
    }
    /**
     * Set status
	 *
     * @param  integer $status
     * @return Type 
     */
    public function setStatus($status){
    	$this->status = $status;
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