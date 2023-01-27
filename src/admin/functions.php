<?php

function mailcoach_plugin_url( $path )
{
    static $base = null;
    if ( $base === null ) {
        $base = plugins_url( '/', MAILCOACH_PLUGIN_FILE );
    }

    return $base . $path;
}
