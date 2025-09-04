<?php 
class Media {
    private string $titre; 
    private string $auteur; 
    private bool $disponible; 

    /**
     * Classe des différents médias contenus dans la médiathèque
     * @param $titre = titre de l'oeuvre
     * @param $auteur = auteur de l'oeuvre
     * @param $disponible = disponibilité de l'oeuvre dans la médiathèque
     */
    public function __construct($titre, $auteur, $disponible){
        $this->titre = $titre; 
        $this->auteur = $auteur; 
        $this->disponible = $disponible; 
    }
    
    public function getTitre() {
        return $this->titre; 
    }

    public function setTitre(string $titre) {
        $this->titre = $titre; 
    }

    public function getAuteur(){
        return $this->auteur; 
    }

    public function setAuteur(string $auteur){
        $this->auteur = $auteur; 
    }

    public function getDisponible(){
        return $this->disponible; 
    }

    /**
     * Méthode pour rendre un média et le mettre à disponibilité true 
     */
    public function rendre(){
        $this->disponible = true; 
    }

    /**
     * Méthode pour emprunter un média et le mettre à disponibilité false 
     */
    public function emprunter(){
        $this->disponible = false; 
        return $this->disponible ; 
    }
}