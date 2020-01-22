<?php
/** 
 * name space pour class Month 
 * 
 */
namespace Calendar;


/**
 *  Month constructor
 * @param int $month le mois compris entre 1 et 12.
 * @param int $year l'année.
 * @throws \Exception
 */
class Month 
{
    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    public $month;
    public $year;
    /**
     * Function constructor for class Month
     */
    public function __construct( ?int $month = null, ?int $year = null) 
    //public function __construct( int $month, int $year) 
    { 
        if ($month === null || $month < 1 || $month > 12) {
            $month = intval(date('m'));

        }
        if ($year === null) {
            $year = intval(date('Y'));
        }


        $this->month = $month;
        $this->year = $year;

    }
    /**
     * Renvoie le premier jour du mois
     * 
     * @return \DateTime
     */
    public function getStartingDay(): \DateTime
    {
        return new \DateTime("{$this->year}-{$this->month}-01");

    }
    /**
     * Retourne le mois en toute lettre (ex: Jan 2020)
     *
     * @return string
     */
    public function toString(): string 
    {

        $string = $this->months[$this->month - 1].' '.$this->year;
        return $string;

    }
    /**
     * Retourne le nombre de semaines dans le moi
     * 
     * @return int
     */
    public function getWeeks(): int
    {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $startWeek = intval($start->format('W'));
        $endWeek = intval($end->format('W'));
        if ($endWeek === 1) {
            $endWeek = intval((clone $end)->modify('-7 days')->format('W')) + 1;
        }
              
        $weeks = $endWeek - $startWeek + 1;
        if ($weeks <0) {
            $weeks = intval($end->format('W'));
        }
        return $weeks;
    }
    /**
     * Est-ce que le jour est dans le mois en cours
     * @param \DateTime $date
     * @return bool
     */
    public function withinMonth(\DateTime $date):bool {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');

    }
    /**
     * Renvoie le mois suivant
     * 
     * @return Month
     */
    public function nextMonth(): Month
    {
        $month = $this->month + 1;
        $year = $this->year;
        if ($month > 12) {
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
    }
    /**
     * Renvoie le mois prédédent
     * 
     * @return Month
     */
    public function previousMonth(): Month
    {
        $month = $this->month -1 ;
        $year = $this->year;
        if ($month <1) {
            $month = 12;
            $year -= 1;
        }
        return new Month($month, $year);
    }
    

}