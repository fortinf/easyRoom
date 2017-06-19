<?php

namespace EasyRoom\AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EasyRoomAppBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
