<?php

namespace Commun\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CommunUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
