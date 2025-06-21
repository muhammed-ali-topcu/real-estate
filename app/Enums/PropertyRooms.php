<?php

namespace App\Enums;

enum PropertyRooms: string {

    case ROOM_1_PLUS_1  = "1+1";
    case ROOM_2_PLUS_1  = "2+1";
    case ROOM_3_PLUS_1  = "3+1";
    case ROOM_4_PLUS_1  = "4+1";
    case ROOM_5_PLUS_1  = "5+1";
    case ROOM_6_PLUS_1  = "6+1";
    case ROOM_7_PLUS_1  = "7+1";
    case ROOM_8_PLUS_1  = "8+1";
    case ROOM_9_PLUS_1  = "9+1";
    case ROOM_10_PLUS_1 = "10+1";

    case ROOM_1_PLUS_0  = "1+0";
    case ROOM_2_PLUS_0  = "2+0";
    case ROOM_3_PLUS_0  = "3+0";
    case ROOM_4_PLUS_0  = "4+0";
    case ROOM_5_PLUS_0  = "5+0";
    case ROOM_6_PLUS_0  = "6+0";
    case ROOM_7_PLUS_0  = "7+0";
    case ROOM_8_PLUS_0  = "8+0";
    case ROOM_9_PLUS_0  = "9+0";
    case ROOM_10_PLUS_0 = "10+0";


    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }

}
