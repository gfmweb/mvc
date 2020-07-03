<?php


namespace widgets;


class Pagination
{
    public  $pagi;
    private $pagi_start;
    private $pagi_body;
    private $pagi_end;
    public function __construct($Position=null,$Pages=0,$Controller=null,$PageName=null)
    {
        if($Pages>0)
        { // Если вообще есть необходимость в пагинации

        // Начало пагинации
            if((!isset($Position)||($Position<=1)))
            {
                $this->pagi_start='<div class="row justify-content-center mt-5">  
                                      <nav aria-label="Page navigation ">
                                          <ul class="pagination pg-blue">
                                              <li class="page-item active">
                                                   <a class="page-link">1 <span class="sr-only">(current)</span></a>
                                              </li>';
            }
            else
            {
                $backIndicator=$Position-1;
                if($backIndicator > 0)
                {$back='                    <li class="page-item ">
                                              <li class="page-item"><a href="/'.$Controller.'/'. $PageName .''.$backIndicator.'" class="page-link">Назад</a></li>
                                           </li> ';}
                else{$back=null;}
                if($Position<=10){$first='<li class="page-item ">
                                              <li class="page-item"><a href="/'.$Controller.'/'.$PageName.'1" class="page-link">1</a></li>
                                          </li>';}
                else{$first=null;}
                $this->pagi_start='<div class="row justify-content-center mt-5">  
                                  <nav aria-label="Page navigation ">
                                      <ul class="pagination pg-blue">
                                           '.$back.'
                                          '.$first.'';
            }
        //Начало тела пагинации
        if ($Pages>10) // Если у нас очень длинная строка
        {
            // Приведение позиции к текущему виду
            if($Position>10)
            {
                $Curent_Pos=intdiv($Position,10);
                $start=10*$Curent_Pos;
                $finish=$start+10;

            }
            else{
                $start=2;
                $finish=10;
            }

            $Tail=ceil($Pages /10);

            for($i=$start; $i<=$finish; $i++)
            {
                if($i===$Position)
                {
                    $this->pagi_body.='<li class="page-item active">
                                               <a class="page-link">'.$i.' <span class="sr-only">(current)</span></a>
                                          </li>';
                }
                else
                {
                    $this->pagi_body.='<li class="page-item ">
                                              <li class="page-item"><a href="/'.$Controller.'/'.$PageName.''.$i.'" class="page-link">'.$i.'</a></li>
                                          </li>';
                }
            }
            $this->pagi_big='<div class="col-12 row justify-content-center"> <nav aria-label="Page navigation ">
                                          <ul class="pagination pg-blue">';
            for($BigI=0;$BigI < $Tail; $BigI++)
            {
                if($BigI==0){$startI=1;$stopI=10;}else{$startI=$BigI*10; $stopI=$startI+10;}
                $this->pagi_big.='<li class="page-item ">
                                              <li class="page-item"><a href="/'.$Controller.'/'.$PageName.''.$startI.'" class="page-link"><small style="white-space: nowrap"><strong>'.$startI.'-'.$stopI.'</strong></small></a></li>
                                          </li>';
            }
            if($Position!==$Pages)
            {
                $NextPage=$Position+1;
                $this->pagi_end=' <li class="page-item ">
                                                    <a href="/'.$Controller.'/'.$PageName.''.$NextPage.'" class="page-link">Далее</a>
                                                </li>
                                            </ul>
                                         </nav>
                                         '.$this->pagi_big.'
                                         </ul>
                                         </nav>
                                         </div>
                                    </div>';
            }
            else{
                $this->pagi_end='</ul>
                              </nav>
                              '.$this->pagi_big.'
                              </ul>
                                         </nav>
                                         </div>
                          </div>';
            }
        }
        else // Если уложились в 10 страниц
        {

            for($i=2; $i<=$Pages; $i++)
            {
                if($i==$Position)
                {
                    $this->pagi_body.='<li class="page-item active">
                                               <a class="page-link">'.$i.' <span class="sr-only">(current)</span></a>
                                          </li>';
                }
                else
                {
                    $this->pagi_body.='<li class="page-item ">
                                              <li class="page-item"><a href="/'.$Controller.'/'.$PageName.''.$i.'" class="page-link">'.$i.'</a></li>
                                          </li>';
                }
            }
            if($Position!==$Pages)
            {

                $NextPage=$Position+1;
                if($NextPage<=$Pages){
                $this->pagi_end=' <li class="page-item ">
                                                    <a href="/'.$Controller.'/'.$PageName.''.$NextPage.'" class="page-link">Далее</a>
                                                </li>
                                            </ul>
                                         </nav>
                                    </div>';
                }
                else{$this->pagi_end='</ul>
                              </nav>
                          </div>';}
            }
            else{
                $this->pagi_end='</ul>
                              </nav>
                          </div>';
            }

        }
        // Окончание пагинации


        }

       $this->pagi=$this->pagi_start.$this->pagi_body.$this->pagi_end;
    }

}