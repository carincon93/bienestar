@extends('layouts.app')

@section('title', 'Sistema')

@section('informacion')
    <blockquote class="blockquote">
        <h4>Sistema</h4>
    </blockquote>
@endsection

@section('content')
    <div class="modal fade" id="confirm-delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-capitalize" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="btn-delete"></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Nav tabs -->
    <div class="d-flex">
        <div id="sidebar-system">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#importar" aria-controls="importar" role="tab" data-toggle="tab">Importar</a></li>
                <li role="presentation"><a href="#exportar" aria-controls="exportar" role="tab" data-toggle="tab">Backup</a></li>
                <li role="presentation"><a href="#eliminar" aria-controls="eliminar" role="tab" data-toggle="tab">Eliminar</a></li>
            </ul>
        </div>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="importar">
                <section class="import-section">
                    <div>
                        <img src="{{ asset('images/import-img.png') }}" alt="" class="img-responsive center-block import-img" width="150px">
                        <br>
                        <p class="text-center">Importar todas las solicitudes desde un archivo excel</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form class="" action="{{ url('admin/aprendiz/store_import') }}" method="post" enctype="multipart/form-data" >
                                <fieldset>
                                    {{ csrf_field() }}
                                    <blockquote class="blockquote">
                                        {{-- <i class="fa fa-fw fa-info"></i>
                                        Selecciona un archivo de excel <i class="fa fa-fw fa-file-excel-o"></i> y da click en <span class="btn">Importar</span> --}}
                                    </blockquote>
                                    <input type="file" name="imported-file"class="form-control" accept=".xlsx" data-multiple-caption="{count} files selected" multiple>
                                    <button type="submit" name="button-import" class="btn btn-success center-block" disabled>
                                        Importar
                                    </button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
            <div role="tabpanel" class="tab-pane" id="exportar">
                <section class="import-section">
                    <div>
                        <img src="{{ asset('images/export-img.png') }}" alt="" class="img-responsive center-block import-img" width="150px">
                        <br>
                        <p class="text-center">Exportar todos los registros del sistema a un archivo en excel</p>
                    </div>
                    <blockquote class="blockquote">
                        {{-- <i class="fa fa-fw fa-info"></i> --}}
                        {{-- Si quieres descargar todos los registros en un archivo excel, por favor da click en el botón <span class="btn">Exportar a excel</span> --}}
                    </blockquote>
                    <div>
                        <a href="{{ url('admin/excel') }}" class="btn btn-success center-block width-button">
                            <i class="fa fa-fw fa-download"></i>
                            Exportar a excel
                        </a>
                    </div>
                </section>
            </div>
            <div role="tabpanel" class="tab-pane" id="eliminar">
                <section class="import-section">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <i class="fa fa-warning fa-4x"></i>
                                {{-- <p>Si quieres eliminar todos los registros, da click en el botón <span class="btn">Eliminar todos los registros</span></p> --}}
                            </div>
                            <blockquote class="blockquote">
                                <p class="text-center">
                                    <i class="fas fa-fw fa-exclamation-triangle"></i>
                                    Se recomienda primero exportar todo a un archivo en excel antes de eliminar.
                                </p>
                            </blockquote>
                            <br>
                            <div>
                                <form action="{{ url('admin/truncate') }}" method="post" class="form-truncate-aprendiz btn btn-danger center-block width-button">
                                    {{ csrf_field() }}
                                    Eliminar todos los registros
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection
