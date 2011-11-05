<?php
        
namespace {{ bundle_namespace }}\Entity;

use Doctrine\ORM\Mapping as ORM;
use {{ bundle_namespace }}\Entity\{{ entity }}Interface;

/**
 * {{ bundle_namespace }}\Entity\{{ entity }}
 * 
 * @author Joris de <joris.w.dewit@gmail.com>
 * 
 * @ORM\Entity
 */
class {{ entity }} implements {{ entity }}Interface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */    
    protected $id;

{% for field in fields %}
{% if field.type == "manyToOne" %}
    /**
     * @var \{{ field.targetEntity }}
     *
     * @ORM\ManyToOne(targetEntity="{{ field.targetEntity }}")
     */
    protected ${{ field.fieldName }};

{% elseif field.type == "oneToMany" %}
    /**
     * @var \{{ field.targetEntity }}
     *
     * @ORM\OneToMany(targetEntity="{{ field.targetEntity }}", mappedBy="{{ field.mappedBy }}", cascade={"{% for item in field.cascade %}{{ item }} {% endfor %}"}, orphanRemoval="{{ field.orphanRemoval }}"
{% elseif field.type == "manyToMany" %}  
     * @ORM\ManyToMany(targetEntity="{{ field.targetEntity }}")
     * @ORM\JoinTable(name="{{ field.joinTable }}",
     *      joinColumns={@ORM\JoinColumn(name="{{ field.mappedBy }}_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="{{ field.fieldName }}_id", referencedColumnName="id")}
     * )
     */
    protected ${{ field.fieldName }}s;

{% elseif field.type == "string" %}
    /**
     * @var string
     *
     * @ORM\Column(type="string", length={{ field.length }}, nullable="true")
     */
    protected ${{ field.fieldName }};

{% elseif field.type == "datetime" %}
    /**
     * @ORM\Column(type="datetime")
     */
    protected ${{ field.fieldName }};

{% else %}
    /**
     * @var {{ field.type }}
     * @ORM\Column(type="{{ field.type }}", nullable="true")
     */
    protected ${{ field.fieldName }};

{% endif %}
{% endfor %}    
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $updatedAt;

    /** 
     * @ORM\PrePersist 
     */
    public function PrePersist()
    {
        $this->createdAt = new \DateTime('now');
    }

    /** 
     * @ORM\PreUpdate 
     */
    public function PreUpdate()
    {
       $this->updatedAt= new \DateTime('now');
    }

    public function __construct() 
    {
{%- for field in fields %}
    {% if (field.type == "oneToMany") or (field.type == "manyToMany") %} 
        $this->{{ field.fieldName }} = new \Doctrine\Common\Collections\ArrayCollection();
    {% endif %}   
{%- endfor %}

    }

    /**
     * Get {{ entity_lc }} id
     *
     * @return integer
     */   
    public function getId()
    {
        return $this->id;
    }

{% for field in fields %}
{% if field.type == "manyToOne" %}
    /**
     * Get {{ field.fieldName }}
     * 
     * @return {{ field.targetEntity }} 
     */
    public function get{{ field.fieldName|capitalize }}()
    {
        return $this->{{ field.fieldName }};
    }

    /**
     * Set {{ field.fieldName }}
     *
     * @param {{ field.type }} ${{ field.fieldName }}
     */
    public function set{{ field.fieldName|capitalize }}(\{{ field.targetEntity }}  ${{ field.fieldName }})
    {
        $this->{{ field.fieldName }} = ${{ field.fieldName }};
    }     
{% elseif (field.type == "oneToMany" or field.type == "manyToMany") %}
    /**
     * Get {{ field.fieldName }}
     * 
     * @return {{ field.targetEntity }} 
     */
    public function get{{ field.fieldName|capitalize }}()
    {
        return $this->{{ field.fieldName }};
    }

    /**
     * Set {{ field.fieldName }}s
     *
     * @param \Doctrine\Common\Collections\ArrayCollection ${{ field.fieldName }}s
     */
    public function set{{ field.fieldName|capitalize }}(\Doctrine\Common\Collections\ArrayCollection  ${{ field.fieldName }}s)
    {
        $this->{{ field.fieldName }}s = ${{ field.fieldName }}s;
    } 
    
    /**
     * Add {{ field.fieldName }} to the collection of related items
     *
     * @param \{{ bundle_namespace }}\Entity\{{ targetEntity }} ${{ field.fieldName  }}   
     */
    public function add{{ field.fieldName }}(\{{ field.targetEntity }} ${{ field.fieldName }})
    {
        $this->{{ field.fieldName }}s->add(${{ field.fieldName }});
        ${{ field.fieldName }}->set{{ field.mappedBy | capitalize }}($this);
    }  

    /**
     * Remove {{ field.fieldName }} from the collection of related items
     *
     * @param \{{ bundle_namespace }}\Entity\{{ targetEntity }} ${{ field.fieldName  }} 
     */
    public function remove{{ field.fieldName}}({{ targetEntity }} ${{ field.fieldName }})
    {
        $this->{{ field.fieldName }}s->removeElement(${{ field.fieldName }})
    }
{% else %}
    /**
     * Get {{ field.fieldName }}
     * 
     * @return {{ field.type }} 
     */
    public function get{{ field.fieldName|capitalize }}()
    {
        return $this->{{ field.fieldName }};
    }
    
    /**
     * Set {{ field.fieldName }}
     *
     * @param {{ field.type }} ${{ field.fieldName }}
     */
    public function set{{ field.fieldName|capitalize }}(${{ field.fieldName }})
    {
        $this->{{ field.fieldName }} = ${{ field.fieldName }};
    }    
{% endif %}       
{% endfor %}
    
    /**
    * Set createdAt
    *
    * @param datetime $createdAt
    */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
       return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
}

