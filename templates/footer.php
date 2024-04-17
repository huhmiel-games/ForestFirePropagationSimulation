<hr>
    <p>
        Énoncé :<br>
        La forêt est représentée par une grille de dimension h x l.<br>

        La dimension temporelle est discrétisée. Le déroulement de la simulation se fait donc étape par étape.<br>

        Dans l’état initial, une ou plusieurs cases sont en feu.<br>

        Si une case est en feu à l’étape t, alors à l’étape t+1 :<br>

        · Le feu s\'éteint dans cette case (la case est remplie de cendre et ne peut ensuite plus brûler)<br>

        · et il y a une probabilité p que le feu se propage à chacune des 4 cases adjacentes<br>

        La simulation s’arrête lorsqu’il n’y a plus aucune case en feu<br>

        Les dimensions de la grille, la position des cases initialement en feu,<br> ainsi que la probabilité de
        propagation, sont des paramètres du programme stockés dans un fichier de configuration (format libre).'</p>

</body>

</html>