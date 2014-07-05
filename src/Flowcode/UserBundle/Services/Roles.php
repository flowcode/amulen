<?php
namespace Flowcode\UserBundle\Services;

/**
 * Roles es un servicio que permite obtener la gerarquia de roles definida en el 
 * security.yml
 *
 * @author Maximiliano Monzón <mmonzon@flowcode.com.ar>
 */
class Roles {
   
    private $roles;

    /**
     * @param array() $hierarchy The rol hierarchy declared in config.yml
     */
    public function __construct($hierarchy = array()) {
        $this->roles = $this->setRoles($hierarchy);
    }
    
    /**
     * Set Roles Dado un array que contiene la gerarquia de roles, parsea los
     * roles y los formatea de manera tal que sea facil listarlos en una pagina
     * web.
     *
     * @param array() $hierarchy
     * @return array
     */
    public function setRoles($hierarchy = array()){
        
        $roles = array();
        
        foreach ($hierarchy as $key => $row) 
        {
            foreach ($row as $key => $haystack) 
            {
                $name = '';
                $roleName = explode('_', $haystack);
                array_shift($roleName);
                
                foreach ($roleName as $part) 
                {
                    $name .= $part . ' ';
                }
                
                $roles[$haystack] = $name;
            }
        }
        
        return $roles;
    }
    
    /**
     * getRoles Retorna la gerarquia de roles definida en el archivo security.yml.
     *
     * @return array()
     */
    public function getRoles(){
        return $this->roles;
    }

    /**
     * Traducir Roles. Dado un array que contiene una lista de roles, pasa dicha
     * lista a la representacion amigable al usuario.
     *
     * @param array() $roles
     * @return array()
     */    
    public function traducirRoles(array $roles)
    {
        $rolesTraducidos = array();
        
        foreach ($this->getRoles() as $key => $value)
        {
            foreach ($roles as $rol)
            {
                if ($rol === $key)
                {
                    $rolesTraducidos[] = $value;
                    break;
                }
            }
        }
        return $rolesTraducidos;
    }
}
