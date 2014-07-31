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


    protected $inputFilter;

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
    * @ORM\PrePersist
    */
    public function setModifiedAt()
    {
        $this->modified_at = new \DateTime();
    }

    /**
    * Get Created Date
    *
    * @return \DateTime
    */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }
    
    /**
    * @ORM\PrePersist
    */
    public function setCreatedAt()
    {
        $this->created_at = new \DateTime();
    }

    /**
    * Get Created Date
    *
    * @return \DateTime
    */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id']))? $data['id'] : null;
        $this->name = (isset($data['name']))? $data['name'] : null;
        $this->value = (isset($data['value']))? $data['value'] : null;
        $this->status = (isset($data['status']))? $data['status'] : null;
    }
     /**
    * Get an array copy of object
    *
    * @return array
    */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
    * Set input method
    *
    * @param InputFilterInterface $inputFilter
    */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Veri tipinde yanlışlık var.");
    }

    /**
    * Get input filter
    *
    * @return InputFilterInterface
    */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'value',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),//burayı bir kontrol et
                    array('name' => 'StringTrim'),//burayı bir kontrol et /name alanı
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'status',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
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

   






}