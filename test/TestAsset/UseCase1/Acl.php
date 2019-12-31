<?php

/**
 * @see       https://github.com/laminas/laminas-permissions-acl for the canonical source repository
 * @copyright https://github.com/laminas/laminas-permissions-acl/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-permissions-acl/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Permissions\Acl\TestAsset\UseCase1;

class Acl extends \Laminas\Permissions\Acl\Acl
{

    public $customAssertion = null;

    public function __construct()
    {
        $this->customAssertion = new UserIsBlogPostOwnerAssertion();

        $this->addRole(new \Laminas\Permissions\Acl\Role\GenericRole('guest'));
        $this->addRole(new \Laminas\Permissions\Acl\Role\GenericRole('contributor'), 'guest');
        $this->addRole(new \Laminas\Permissions\Acl\Role\GenericRole('publisher'), 'contributor');
        $this->addRole(new \Laminas\Permissions\Acl\Role\GenericRole('admin'));
        $this->addResource(new \Laminas\Permissions\Acl\Resource\GenericResource('blogPost'));
        $this->allow('guest', 'blogPost', 'view');
        $this->allow('contributor', 'blogPost', 'contribute');
        $this->allow('contributor', 'blogPost', 'modify', $this->customAssertion);
        $this->allow('publisher', 'blogPost', 'publish');
    }
}
