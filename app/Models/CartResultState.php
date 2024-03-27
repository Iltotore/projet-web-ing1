<?php

namespace App\Models;

enum CartResultState: string {

    case Ok = "ok";
    case Full = "full";
    case Delete = "delete";
    case DoesNotExist = "doesNotExist";
}
