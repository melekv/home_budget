<?php

namespace App\Entity;

enum ExpenseType: string
{
    case Income = 'INCOME';
    case Outcome = 'OUTCOME';
}
