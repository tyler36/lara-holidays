<?php

return [
    /**
     * What days are considered a workday?
     * number between 1 (monday) and 7 (sunday)
     * ISO-8601 numeric representation of the day of the week
     */
    'workdays' => [ 1, 2, 3, 4, 5 ],

    /**
     * Configure the holiday provider region
     *
     * See https://github.com/azuyalabs/yasumi/tree/develop/src/Yasumi/Provider
     *
     */
    'locale' => 'Japan',
];
