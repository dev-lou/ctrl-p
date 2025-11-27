<?php

namespace App\Extensions;

use Illuminate\Database\Connectors\PostgresConnector as BasePostgresConnector;
use PDO;

class NeonPostgresConnector extends BasePostgresConnector
{
    /**
     * Create a DSN string from a configuration and append Neon endpoint id when present.
     *
     * @param  array  $config
     * @return string
     */
    protected function getDsn(array $config)
    {
        $dsn = parent::getDsn($config);

        if (! empty($config['neon_endpoint'])) {
            // Append the endpoint to DSN as a libpq option so Neon receives SNI
            $dsn .= ";options=endpoint=" . $config['neon_endpoint'];
        }

        return $dsn;
    }

    /**
     * Get the PDO options based on the configuration, ensuring options is an array.
     *
     * @param  array  $config
     * @return array
     */
    public function getOptions(array $config)
    {
        $options = $config['options'] ?? [];

        if (! is_array($options)) {
            $options = [];
        }

        return array_diff_key($this->options, $options) + $options;
    }
}
