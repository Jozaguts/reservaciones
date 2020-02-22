<template>
  <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-dark font-weight-bold">Tipo de comisionistas</div>
                    <div class="card-body">
                        <div class="row justify-content-end my-2">
                            <a href="#!" class="btn btn-success" data-toggle="modal" data-target="#comisionistasForm"><span class="font-weight-bolder">+</span> Tipo de comisionista</a>
                        </div>
                            <div class="row" >
                                <comisionistas-table></comisionistas-table>
                                <comisionistas-form></comisionistas-form>
                            </div>
                    </div>
                </div>
            </div>
</template>

<script>

import FormComisionistas from '../components/Comisionistas/ComisionistasForm';
import TableComisionistas from '../components/Comisionistas/ComisionistasTable';

export default {

    components: {
        "comisionistas-table":TableComisionistas,
        "comisionistas-form": FormComisionistas
    }

}
</script>
