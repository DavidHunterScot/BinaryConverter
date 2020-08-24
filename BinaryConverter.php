<?php

namespace DavidHunterScot;

/*
		BINARY CONVERTER CLASS
		by David Hunter
		
		davidhunter.scot
		@DavidHunterScot
*/

class BinaryConverter {

	/**
	 *		Check if String is valid Binary.
	 *		@param String $string The string to check.
	 *		@return bool A boolean value indicating whether valid or not.
	 */
	public function is_binary( String $string ): bool {
		// Immediately return false if an empty string was provided.
		if( empty( $string ) ) return false;
		
		// Split the string up into an array containing each character.
		$string = str_split( $string );
		
		// Go through each character.
		for( $s = 0; $s < count( $string ); $s++ ) {
			// Return false if the current character is not a 0 and not a 1.
			if( $string[ $s ] != "0" && $string[ $s ] != "1" )
				return false;
		}
		
		// Must be valid binary, return true.
		return true;
	}
	
	/**
	 *		Convert Binary to Decimal
	 *		@param String $binary The binary value to convert as String.
	 *		@return int The converted decimal value as Integer.
	 */
	public function bin2dec( String $binary ): int {
		// Check if string is actually valid binary, and return 0 if not.
		if( !$this->is_binary( $binary ) ) return 0;
		// Reverse the binary string, because the conversion works right to left.
		$binary = strrev( $binary );
		// Split the binary string into an iterable array.
		$binary = str_split( $binary );
		// Set a default number as integer to output should it not change.
		$number = 0;
		
		// Iterate through each binary element.
		for( $b = 0; $b < count( $binary ); $b++ ) {
			// Get current binary element based on iteration counter.
			$i = $binary[ $b ];
			
			// Check if current element is 1 (same as true)
			if( $i )
				// Increment final number by raising 2 to power of iteration counter.
				$number += pow( 2, $b );
		}
		
		// Return the final number value.
		return $number;
	}
	
	/**
	 *		Convert Decimal to Binary
	 *		@param int $decimal The decimal value to convert as an Integer.
	 *		@return String The converted binary.
	 */
	public function dec2bin( int $decimal ): String {
		// Prepare variable to hold converted binary.
		$binary = "";
		
		// While the decimal value remains greater than zero...
		while( $decimal > 0 ) {
			// Append to the binary the result of the decimal modular 2.
			$binary .= $decimal % 2;
			// Divide the decimal by 2 to half it.
			$decimal /= 2;
		}
		
		// Trim zeros from the ends of the binary string.
		$binary = rtrim( $binary, "0" );
		// Reverse the binary string.
		$binary = strrev( $binary );
		// Return the binary string.
		return $binary;
	}
	
	/**
	 *		Generate HTML Conversion
	 *		@param String $binary The binary to convert.
	 *		@return String The HTML.
	 */
	public function generateHTML( String $binary ): String {
		// Prepare a variable to hold the generated HTML.
		$html = "";
		
		// Append CSS code to the HTML to make things more visually pleasing.
		$html .= '<style type="text/css">
			body { font-family: sans-serif; font-size: 50px; }
		</style>';
		
		// Generate Text Only Conversion
		$text = $this->generateTextOnly( $binary );
		// Append the Text Only Conversion to the HTML,
		// and replace new lines with break lines and new lines.
		$html .= str_replace( "\n", "<br>\n", $text );
		
		// Return generated HTML.
		return $html;
	}
	
	/**
	 *		Generate Text Only Conversion
	 *		@param String $binary The binary to convert.
	 *		@return String The Text.
	 */
	public function generateTextOnly( String $binary ) {
		// Prepare variable to hold the generated text.
		$text = "";
		
		// Append the binary value to the HTML.
		$text .= $binary;
		// Convert binary to decimal and hold in a variable.
		$dec = $this->bin2dec( $binary );
		// Append an equals sign followed by the conversion result to the HTML.
		$text .= " = " . $dec;
		// Append a new line to the HTML.
		$text .= "\n";
		// Append the converted decimal followed by an equals sign to the HTML.
		$text .= $dec . " = ";
		// Convert and Append the converted binary to the HTML.
		$text .= $this->dec2bin( $dec );
		
		// Return the HTML.
		return $text;
	}

}

// New instance of the Binary Converter class.
$bc = new BinaryConverter;
// Set the binary value.
$binary = "10101010";

// Set content type to plain text.
//header("Content-Type: text/plain");

// Output the generated Text Only Conversion based on the above binary value.
//echo $bc->generateTextOnly( $binary );

// Output the generated HTML Conversion based on the above binary value.
echo $bc->generateHTML( $binary );

