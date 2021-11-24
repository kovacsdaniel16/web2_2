<h2>Előadások adatai:</h2>

    <div id = 'informaciosdiv'>
      <div id = 'teruletinfo'>
        <span class="cimke">Előadó:</span><span id="eloado" class="adat"></span><br>
        <span class="cimke">Előadás:</span><span id="eloadas" class="adat"></span><br>
        <span class="cimke">Témakör:</span><span id="temakor" class="adat"></span><br>
        <span class="cimke">Dátum:</span><span id="datum" class="adat"></span><br>
      </div>
      <label for='teruletcimke'>Ország:</label>
      <select id = 'teruletselect'></select>
      <br><br>
      <label for = 'nevcimke'>Város:</label>
      <select id = 'nevselect'></select>
      <br><br>
      <label for = 'nevcimke'>Intézmény:</label>
      <select id = 'eloadasselect'></select>
      
      <?php echo $keresoModel?>

    </div>