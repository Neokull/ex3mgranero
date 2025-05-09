<?php
require_once "autoload.php";

class Lighting extends Connection
{
    public function getAllLamps()
    {
        $lamps = [];

        $sql = "SELECT lamps.lamp_id, lamps.lamp_name, lamp_on, lamp_models.model_part_number,lamp_models.model_wattage, zones.zone_name FROM lamps INNER JOIN lamp_models ON lamps.lamp_model=lamp_models.model_id INNER JOIN zones ON lamps.lamp_zone = zones.zone_id ORDER BY lamps.lamp_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lamp = new Lamp(
                $row['lamp_id'],
                $row['lamp_name'],
                $row['lamp_on'],
                $row['model_part_number'],
                $row['model_wattage'],
                $row['zone_name']
            );
            $lamps[] = $lamp;
        }

        return $lamps;
    }

function drawLampsList()
{
    $lamps = $this->getAllLamps();
    $html = '';

    foreach ($lamps as $lamp) {
        $currentStatus = $lamp->getOn() ? 1 : 0;
        $newStatus     = $currentStatus ? 0 : 1;

        $statusClass = $currentStatus ? 'on' : 'off';
        $imageSrc    = $currentStatus ? 'img/bulb-icon-on.png' : 'img/bulb-icon-off.png';
        $lampId      = $lamp->getId();

        $html .= '<div class="element ' . $statusClass . '">';
        $html .= '<h4>';
        $html .= '<a href="changestatus.php?id=' . $lampId . '&status=' . $newStatus . '">';
        $html .= '<img src="' . $imageSrc . '" alt="bulb">';
        $html .= '</a> ';
        $html .= htmlspecialchars($lamp->getName(), ENT_QUOTES, 'UTF-8');
        $html .= '</h4>';
        $html .= '<h1>' . (int)$lamp->getWattage() . ' W.</h1>';
        $html .= '<h4>' . htmlspecialchars($lamp->getZone(), ENT_QUOTES, 'UTF-8') . '</h4>';
        $html .= '</div>';
    }

    return $html;
}

    public function getPower()
    {
        $sql = "SELECT zones.zone_name, SUM(lamp_models.model_wattage) as power FROM lamps INNER JOIN lamp_models ON lamps.lamp_model = lamp_models.model_id INNER JOIN zones ON lamps.lamp_zone = zones.zone_id WHERE lamp_on = 1 GROUP BY zones.zone_name";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $power = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $power[$row['zone_name']] = $row['power'] . " W";
        }

        return $power;
    }

    public function drawMonitor()
    {
        $zonesPower = $this->getPower();
        $html = '<h3>Potencia por zona:</h3><ul>';

        foreach ($zonesPower as $zone => $power) {
            $html .= '<li><strong>' . $zone . ':</strong> ' . $power . '</li>';
        }

        $html .= '</ul>' . '<h3>Total potencia estadio:</h3>' . '<span>' . array_sum($this->getPower())  . ' W'. '</span>';
        return $html;
    }

    public function changeStatus($id, $status)
    {
        $sql = 'UPDATE lamps SET lamp_on = :status WHERE lamp_id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}
