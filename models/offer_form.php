<div class="form-element">
  <div class="overlay" onclick="showForm();"></div>
  <div class="form">
    <h2>Edycja produktu</h2>
    <form method="POST" id="form">
      <input type="hidden" name="action" value="add">
      <input type="hidden" name="type" value="offer">
      <input type="hidden" name="id" value="<?php echo $id ?>">
      <div class="label">Nazwa</div>
      <input type="text" name="nazwa" value="<?php echo $nazwa ?>" required>
      <div class="label">Opis</div>
      <div id="editor">
        <?php echo $opis ?>
      </div>
      <textarea name="opis" style="display:none" id="hiddenDescription"></textarea>
      <div class="label">Cena</div>
      <input type="text" name="cena" pattern="([0-9]+.{0,1}[0-9]*,{0,1})*[0-9]" value="<?php echo $cena ?>" required>
      <div class="label">Zdjecie</div>
      <input type="text" name="zdjecie" value="<?php echo $zdjecie ?>" required>
      <button type="submit" onclick="showForm();">Zapisz</button>
      <div onclick="showForm();">Anuluj</div>
    </form>
  </div>
</div>