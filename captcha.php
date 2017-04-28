<?php
/*

  Written By Gaston Borysiuk
  contact at gaston.borysiuk@gmail.com
  27/04/2017 16:33:51 - 

*/


class Captcha 
{
  // Aquí se ingresan los atributos de la clase
  var $Estado; // Variable de mierda que estaba en el snippet
  var $text; // Texto para el catpcha
  var $lenght; // strlen del catpcha
  var $height; // Alto del contenedor del captcha
  var $width; // ancho del contenedor del captcha
  var $bgcolor; // Variable para el color del background
  var $fcolor; // Variable para el color del texto
  var $con_lineas = true; // Variable para determinar si ponemos lineas aleatorias en el captcha o no
  var $lineas = 5; // Define la cantida de lineas para el captcha
  var $puntos = 100; // Define la cantidad de puntos aleatorios de diferentes colores que se agregan a la img

  // Constructor de la Clase
  function __construct($lenght=6, $height=60, $width=120, $color="#111111", $bgcolor="#3378B0", $text="") 
  {
	 $this->Estado = true;


	 $this->text = $text;
	 $this->lenght = $lenght;
	 $this->height = $height;
	 $this->width = $width;
	 $this->bgcolor = $bgcolor;
	 $this->fcolor = $color;

  }

  // Destructor de la clase
  function __destruct()
  {
	 $this->Estado = false;
	 return "Objeto Destruido";
  }

  function __call($metodo, $atributo)
  {
	 echo "El metodo " . $metodo . " es inexistente Captcha ";
  }

  /* ---------------------- Aca comienzan las funciones de la clase --- */
  public function GenerarCaptcha()
  {
	 $this->GenerarTexto();

	 return (object) array('texto' => $this->text,
								  'captcha'=> $this->GenerarImagen());
  }


  // funcion para generar el texto aleatorio
  private function GenerarTexto()
  {
	 $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	 
	 $this->text = "";
	 for ($i=0; $i < $this->lenght; $i++) 
	   {	
		  $this->text.= substr($caracteres, rand(0,strlen($caracteres)), 1);
	   }
  }

  // Función para Generar la imagen con el captcha;
  private function GenerarImagen()
  {
	 $filename = sha1(mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')) . $_SERVER['HTTP_HOST'] . rand(0,1800)) . ".png";

	 $img = imagecreate(intval($this->width), intval($this->height));
	 
	 /* -------------------------------------- ESTO --- */
	 // Esto es un chanchuyo que hice, por algún motivo si no pongo el color 2 veces no anda pero
	 // me di cuenta que si pones 2 veces el mismo número las letras con relleno ej O, B, D, ponen un relleno, 
	 // pero el relleno queda el color que pones en primer lugar, por eso primero convierto el color (hexa) a decimal del BG
	 // y luego convierto el color de la letra

	 $color = $this->ParsearColor($this->bgcolor);
	 $fcolor = imagecolorallocate($img, $color[0], $color[1], $color[2]);
	 
	 // Color de la fuente

	 $color = $this->ParsearColor($this->fcolor);
	 $fcolor = imagecolorallocate($img, $color[0], $color[1], $color[2]);
	 /* ----------------------------------------------- */

	 // Color de Fondo
	 $color = $this->ParsearColor($this->bgcolor);
	 $backcolor = imagecolorallocate($img, $color[0], $color[1], $color[2]);

	 // Imprime el texto
	 imagestring($img, 8, rand(0, 10), rand(0, round($this->height/2)), $this->ProcesarTexto(), $fcolor); 

	 // En codeigniter vi que agregan lineas al catpcha (son para que no hagan algo para saltar el catpcha) 
	 // Si queres desactivarlas busca la variable $con_lineas y ponele valor = false;
	 if ($this->con_lineas)
		{
		  for ($i=0; $i < $this->lineas; $i++) 
		    {	
				$rcolor = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
				imageline($img, $sw=rand(0, $this->width), $sh=rand(0,$this->height), rand($sw, ($this->width - $this->lenght)), rand($sh, ($this->height - 3)), $rcolor);

				$rcolor = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
				imageline($img, $sw=rand(0, $this->width), $sh=rand(0,$this->height), rand($sw, ($this->width - $this->lenght)), rand($sh, ($this->height - 3)), $rcolor);

		    }
		}
	 
	 
	 // bucle para agregarle puntos aleatorios por todos lados en la img
	 for ($i=0; $i < $this->puntos; $i++) 
		{ 
		  $rcolor = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
		  imagesetpixel( $img, rand(0, $this->width), rand(0, $this->height), $rcolor); 
		} 


	 imagefill($img, 0, 0, $backcolor);
	 imagepng($img, './pepe/' . $filename);

	 return $filename;
  }

  private function ParsearColor($color)
  {
	 $color = str_replace("#", "", $color);

	 return array(hexdec(substr($color, 0, 2)),
					  hexdec(substr($color, 2, 2)),
					  hexdec(substr($color, 4, 2)));
  }

  private function ProcesarTexto()
  {
	 $texto = $this->text;

	 $t = "";
	 for($i=0; $i < strlen($texto); $i++)
		{
		  $t.= substr($texto, $i, 1) . " ";
		}

	 return $t;
		  
  }
  
}

?>
