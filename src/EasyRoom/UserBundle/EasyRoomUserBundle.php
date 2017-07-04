<?php

namespace EasyRoom\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EasyRoomUserBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
