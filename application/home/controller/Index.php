<?php
namespace app\home\controller;

class Index extends Base
{
    public function index()
    {
    	return $this->fetch('/index');
    }

    public function test()
    {
    	for($i=1;$i<10;$i++){
			for($j=1;$j<=$i;$j++){
				echo $i.'*'.$j.'='.$i*$j."&nbsp;&nbsp;";
			}
			echo "<br>";			
		}

		for($a=1;$a<=18;$a++){//18是因为全买公鸡
			for($b=1;$b<=31;$b++){
				for($c=1;$c<=100;$c++){
					if(($a+$b+$c==100)&&(5*$a+3*$b+$c/3==100)){
						echo "公鸡{$a}只,母鸡{$b}只,小鸡{$c}只<br>";
					}
				}
			}
		}

		$tianqi = get_weather();print_r($tianqi);
    }

}
