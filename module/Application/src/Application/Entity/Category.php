<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class Category implements InputFilterAwareInterface
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
     * @ORM\Column(name="category_name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer")
     */
    private $parentId;

    /**
     * @ORM\ManyToOne(targetEntity="CategoryGroup")
     * @ORM\JoinColumn(name="category_group_id", referencedColumnName="id")
     */
    private $catId;

    /**
     * @ORM\ManyToOne(targetEntity="Url")
     * @ORM\JoinColumn(name="core_url_id", referencedColumnName="id")
     */
    
    private $urlId;

     /**
     * @ORM\ManyToOne(targetEntity="Website")
     * @ORM\JoinColumn(name="core_website_id", referencedColumnName="id")
     */
    
    private $websiteId;


    /**
     * @var string
     *
     * @ORM\Column(name="icon_spec", type="string", length=50, nullable=false)
     */
    private $icon;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    
    private $status;


    protected $inputFilter;

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
    * Set parentId
    *
    * @param string $parentId
    * @return Category
    */

    public function getParentId(){
        return $this->parentId;

   }
   


    /**
    * Set name
    *
    * @param string $name
    * @return Category
    */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
    * Get name
    *
    * @return string
    */
    public function getName()
    {
        return $this->name;
    }


    /**
    * Set icon
    *
    * @param string $icon
    * @return Category
    */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
    * Get name
    *
    * @return string
    */
    public function getIcon()
    {
        return $this->icon;
    }


    /**
    * Get url
    *
    * @param integer $urlId
    * @return Category
    */
    

    public function getUrl(){
         
        return $this->urlId;

    }


    /**
    * Set url
    *
    * @param integer $urlId
    * @return Category
    */
    

    public function setUrl($urlId){
        $this->urlId = $urlId;
        return $this;

    }

    

    /**
    * Exchange array - used in ZF2 form
    *
    * @param array $data An array of data
    */
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id']))? $data['id'] : null;
        $this->name = (isset($data['name']))? $data['name'] : null;
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
        throw new \Exception("Not used");
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
                            'max'      => 255,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}