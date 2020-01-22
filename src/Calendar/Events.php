<?php
/**
 * Le fichier events sert à manipuler et récupérer les évènements
 *  
 * */ 

namespace Calendar;
/**
 * Récupère les évenements commençant entre 2 dates
 * @param \DateTime $start
 * @param \DateTime $end
 * @return array
 * 
 */
class Events
{
    private $pdo;
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    /**
     * Récupère les évenements commençant entre 2 dates
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */    
    public function getEventsBetween(\DateTime $start, \DateTime $end): array
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=calendar', 'root', '', [ \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, 
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC]);
        $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ORDER BY start ASC";
        //var_dump($sql);
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }

    /**
     * Récupère les évenements commençant entre 2 dates indexé par jour
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     * 
     * 
     */
    public function getEventsBetweenByDay(\DateTime $start, \DateTime $end): array
    {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach ($events as $event) {
            $date = explode(' ', $event['start'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }

    /**
     * Récupère un événement
     * @param int $id
     * @return Event
     * @throws \Exception
     */
    public function find(int $id): Event
    {
        include 'Event.php';
        $statement =  $this->pdo->query("SELECT * FROM events WHERE id = $id LIMIT 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, Event::class);
        $result = $statement->fetch();
        if ($result === false) {
            throw new \Exception("Aucun résultat n\'a été trouvé", 1);
            
        } 
        return $result;
        
       
    }
    /**
     * Crée un évènement au niveau de la base de donnée
     * @param Event $event
     * @return bool
     * 
     */
    public function create(Event $event): bool 
    {
        $statement = $this->pdo->prepare('INSERT INTO events(name, description, start, end) VALUES (?, ?, ?, ?)');
        return $statement->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s')
        ]);
    }
    /**
     * Met à jour un évènement au niveau de la base de donnée
     * @param Event $event
     * @return bool
     * 
     */
    public function update(Event $event): bool 
    {
        
        $statement = $this->pdo->prepare('UPDATE events SET name = ?, description = ?, start = ?, end = ? WHERE id = ?');
        return $statement->execute([
            $event->getName(),
            $event->getDescription(),            
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
            $event->getId()
        ]);
    }
    /**
     * Supprimer un évènement
     * @param Event $event
     * @return bool
     * 
     */
    public function delete(Event $event): bool 
    {
        
        $statement = $this->pdo->prepare('DELETE FROM events WHERE id = ?');
        return $statement->execute([            
            $event->getId()
        ]);
    }
}
