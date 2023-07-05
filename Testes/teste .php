<style>
  form div {
    display: none;
    color: red
  }

  input[type='radio']:checked+div {
    display: inline-block
  }
</style>
<form>
  <label for='div1'>Opção 1</label>
  <input type='radio' id='div1' name='consulta[]' value='1'>
  <div id='m1'>
    DIV 1
  </div>

  <label for='div2'>Opção 2</label>
  <input type='radio' id='div2' name='consulta[]' value='2'>
  <div id='m2'>
    DIV 2
  </div>
</form>

<div class="accordion-item">
  <h2 class="accordion-header" id="headingOne">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      
    </button>
  </h2>
  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
    <div class="accordion-body">

    </div>
  </div>
</div>