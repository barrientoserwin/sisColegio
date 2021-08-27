<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ _('CJ') }}</a>
            <a href="#" class="simple-text logo-normal">{{ _('Sistema Escolar') }}</a>
        </div>
        <ul class="nav">
            <li @click="menu=0" class="nav-item">
                <a href="#" class="nav-link"><i class="tim-icons icon-chart-pie-36"></i><p>{{ _('Escritorio') }}</p></a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('Gestion Academica') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @click="menu=1" class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-clipboard"></i><p>{{ _('Año Escolar') }}</p></a>
                        </li>
                        <li @click="menu=2" class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-list-ol"></i><p>{{ _('Cursos') }}</p></a>
                        </li>
                        <li @click="menu=3" class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-book"></i><p>{{ _('Materias') }}</p></a>
                        </li>
                        <li @click="menu=4" class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-table"></i><p>{{ _('Adm /Gestion-Curso') }}</p></a>
                        </li>
                        <li @click="menu=5" class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-address-card"></i><p>{{ _('Profesor Materia') }}</p></a>
                        </li>
                        <li @click="menu=6" class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-window-restore"></i><p>{{ _('Curso - Paralelos') }}</p></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#inscripcion" aria-expanded="false">
                    <i class="fa fa-list" ></i>
                    <span class="nav-link-text" >{{ __('Inscripciones') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="inscripcion">
                    <ul class="nav pl-4">
                        <li @click="menu=7" class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-plus-circle"></i><p>{{ _('Inscripcion') }}</p></a>
                        </li>
                        <li @click="menu=8" class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-font"></i><p>{{ _('Alumnos') }}</p></a>
                        </li>
                        <li @click="menu=9" class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-table"></i><p>{{ _('Horarios') }}</p></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#factura" aria-expanded="false">
                    <i class="tim-icons icon-coins" ></i>
                    <span class="nav-link-text" >{{ __('Facturacion') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse" id="factura">
                    <ul class="nav pl-4">
                        <li @click="menu=10" class="nav-item">
                            <a href="#" class="nav-link"><i class="tim-icons icon-single-02"></i><p>{{ _('Admin Mensualidad') }}</p></a>
                        </li>
                        <li @click="menu=11" class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-list-alt"></i><p>{{ _('Caja Pago / Factura') }}</p></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#boletin" aria-expanded="false">
                    <i class="tim-icons icon-bullet-list-67" ></i>
                    <span class="nav-link-text" >{{ __('Boletin de Notas') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse" id="boletin">
                    <ul class="nav pl-4">
                        <li @click="menu=12" class="nav-item">
                            <a href="#" class="nav-link"><i class="tim-icons icon-bullet-list-67"></i><p>{{ _('Notas') }}</p></a>
                        </li>
                        <li @click="menu=13" class="nav-item">
                            <a href="#" class="nav-link"><i class="fa fa-list-alt"></i><p>{{ _('Boletines') }}</p></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#acceso" aria-expanded="false">
                    <i class="tim-icons icon-lock-circle" ></i>
                    <span class="nav-link-text" >{{ __('Administrar Acceso') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse" id="acceso">
                    <ul class="nav pl-4">
                        <li @click="menu=14" class="nav-item">
                            <a href="#" class="nav-link"><i class="tim-icons icon-single-02"></i><p>{{ _('Usuario') }}</p></a>
                        </li>
                        <li @click="menu=15" class="nav-item">
                            <a href="#" class="nav-link"><i class="tim-icons icon-satisfied"></i><p>{{ _('Profesores') }}</p></a>
                        </li>
                        <li @click="menu=16" class="nav-item">
                            <a href="#" class="nav-link"><i class="tim-icons icon-satisfied"></i><p>{{ _('Secretaria') }}</p></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @click="menu=17" class="nav-item">
                <a href="#" class="nav-link"><i class="fa fa-male"></i><p>{{ _('Apoderados') }}</p></a>
            </li>
            <li @click="menu=18" class="nav-item">
                <a href="#" class="nav-link"><i class="fa fa-male"></i><p>{{ _('Asistencia') }}</p></a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="tim-icons icon-world"></i><p>{{ _('Acerca de...') }}</p></a>
            </li>
        </ul>
    </div>
</div>
