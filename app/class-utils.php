<?php

namespace App;

class Utils {
    /**
     * Returns item from array or $default if item is not set.
     *
     * @param array $arr
     * @param string $key
     * @param mixed $default
     *
     * @return mixed Array element
     */
    public static function get_el( $arr, $key, $default = null ) {
        if ( empty( $arr ) || ! is_array( $arr ) ) {
            return $default;
        }

        return array_key_exists( $key, $arr ) ? $arr[ $key ] : $default;
    }

    /**
     * @param $search
     * @param $replace
     * @param $subject
     *
     * @return string
     */
    public static function str_lreplace( $search, $replace, $subject ) {
        $pos = strrpos( $subject, $search );

        if ( $pos !== false ) {
            $subject = substr_replace( $subject, $replace, $pos, strlen( $search ) );
        }

        return $subject;
    }

    public static function get_image_url_by_id( $id ) {
        $src = wp_get_attachment_image_src( $id, 'large' );

        return self::get_el( $src, 0, '' );
    }

    /*
    * Works better than standard strip_tags
    * */
    public static function strip_tags( $string ) {

        // ----- remove HTML TAGs -----
        $string = preg_replace( '/<[^>]*>/', ' ', $string );

        // ----- remove control characters -----
        $string = str_replace( "\r", '', $string );    // --- replace with empty space
        $string = str_replace( "\n", ' ', $string );   // --- replace with space
        $string = str_replace( "\t", ' ', $string );   // --- replace with space

        // ----- remove multiple spaces -----
        $string = trim( preg_replace( '/ {2,}/', ' ', $string ) );

        return $string;

    }

    public static function add_query_arg( $name, $val ) {
        return $val ?
            home_url( add_query_arg( [ $name => $val ] ) ) :
            home_url( remove_query_arg( $name ) );
    }

    public static function get_current_url() {
        return home_url( add_query_arg( $_GET ) );
    }

	/**
	 * @param array $order
	 * @param int $size
	 *
	 * @return array|false
	 */
	protected static function get_next_array_order( $order, $size ) {
		// slide down the array looking for where we're smaller than the next guy
		$i = $size - 1;
		while ( isset( $order[ $i ] ) && $order[ $i ] >= $order[ $i + 1 ] ) {
			$i --;
		}

		// if this doesn't occur, we've finished our permutations, the array is reversed: (1, 2, 3, 4) => (4, 3, 2, 1)
		if ( $i == - 1 ) {
			return false;
		}

		// slide down the array looking for a bigger number than what we found before
		$j = $size;

		while ( $order[ $j ] <= $order[ $i ] ) {
			$j --;
		}

		// swap them
		$tmp         = $order[ $i ];
		$order[ $i ] = $order[ $j ];
		$order[ $j ] = $tmp;

		// now reverse the elements in between by swapping the ends
		for ( ++ $i, $j = $size; $i < $j; ++ $i, -- $j ) {
			$tmp         = $order[ $i ];
			$order[ $i ] = $order[ $j ];
			$order[ $j ] = $tmp;
		}

		return $order;
	}

	/**
	 * Get all the order variants of given array values
	 *
	 * @param array $arr
	 *
	 * @return array[]
	 */
	public static function get_array_orders( $arr ) {
		$arr    = array_values( $arr ); // Make sure array begins from 0.
		$size   = count( $arr ) - 1;
		$order  = range( 0, $size );
		$i      = 0;
		$orders = [];
		do {
			foreach ( $order as $key ) {
				$orders[ $i ][] = $arr[ $key ];
			}

			$i ++;
		} while ( $order = self::get_next_array_order( $order, $size ) );

		return $orders;
	}
}
