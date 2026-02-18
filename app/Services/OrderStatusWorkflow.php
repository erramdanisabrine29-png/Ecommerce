<?php
namespace App\Services;

class OrderStatusWorkflow
{
    // Status codes and labels
    public const STATUSES = [
        'NEW ORDER', 'CONFIRMED', 'NO ANSWER', 'BUSY', 'CANCELLED',
        'CALL LATER', 'DOUBLE COMMANDE', 'LIVRED', 'REFUSED'
    ];

    // Final states
    public const FINAL_STATUSES = [
        'LIVRED', 'CANCELLED', 'REFUSED'
    ];

    // Workflow transitions
    public static function workflow(): array
    {
        return [
            'NEW ORDER' => ['CONFIRMED', 'NO ANSWER', 'BUSY', 'CANCELLED'],
            'NO ANSWER' => ['CALL LATER', 'CANCELLED'],
            'BUSY' => ['CALL LATER', 'CANCELLED'],
            'CALL LATER' => ['CONFIRMED', 'CANCELLED'],
            'CONFIRMED' => ['LIVRED', 'DOUBLE COMMANDE', 'REFUSED', 'CANCELLED'],
            'LIVRED' => [],
            'CANCELLED' => [],
            'REFUSED' => [],
            'DOUBLE COMMANDE' => [], // requires manual review
        ];
    }

    public static function isFinal(string $status): bool
    {
        return in_array($status, self::FINAL_STATUSES);
    }

    public static function canTransition(string $from, string $to): bool
    {
        $workflow = self::workflow();
        return isset($workflow[$from]) && in_array($to, $workflow[$from]);
    }

    public static function diagram(): array
    {
        $nodes = array_map(fn($s) => ['id' => $s, 'final' => self::isFinal($s)], self::STATUSES);
        $edges = [];
        foreach (self::workflow() as $from => $tos) {
            foreach ($tos as $to) {
                $edges[] = ['from' => $from, 'to' => $to];
            }
        }
        return ['nodes' => $nodes, 'edges' => $edges];
    }
}
