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
     * @ORM\Column(name="core_url_key", type="string", length=100, nullable=false)
     */
    private $name;//core_url_key varchar 100 uniq


    
    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    
    private $status;//status integer 1 
    //create_time timestamp
    //update_time timestamp
    

    protected $inputFilter;

}