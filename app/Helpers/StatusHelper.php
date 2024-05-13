<?php

namespace App\Helpers;

class StatusHelper
{
    public static function getStatusColor($status)
    {
        switch ($status) {
            case 'pending':
                return 'bg-warning';
            case 'processing':
                return 'bg-primary';
            case 'completed':
                return 'bg-success';
            case 'rejected':
                return 'bg-danger';
            default:
                return 'bg-secondary';
        }
    }
}
