<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('poin-{id}', function ($user, $id) {
    return true;
});
Broadcast::channel('arena-{id}', function ($user, $id) {
    return true;
});
Broadcast::channel('gelanggang-{id}', function ($user, $id) {
    return true;
});
Broadcast::channel('verifikasi-{id}', function ($user, $id) {
    return true;
});
