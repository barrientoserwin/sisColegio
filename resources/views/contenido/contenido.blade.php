@extends('index')

@section('content')
    <template v-if="menu==0">
        <example-component></example-component>
    </template>
    
    <template v-if="menu==1">
        <frm-gestion></frm-gestion>
    </template>
    
    <template v-if="menu==2">
        <frm-curso></frm-curso>
    </template>

    <template v-if="menu==3">
        <frm-materia></frm-materia>
    </template> 

    <template v-if="menu==4">
        <frm-gestion-curso></frm-gestion-curso>
    </template>
    
    <template v-if="menu==5">
        <frm-curso-materia></frm-curso-materia>
    </template>

    <template v-if="menu==6">
        <frm-curso-paralelo></frm-curso-paralelo>
    </template>
        
    <template v-if="menu==7">
        <frm-inscripcion></frm-inscripcion>
    </template>

    <template v-if="menu==8">
        <frm-alumno></frm-alumno>
    </template>

    <template v-if="menu==10">
        <frm-pago-mensual></frm-pago-mensual>
    </template>

    <template v-if="menu==11">
        <frm-factura></frm-factura>
    </template>

    <template v-if="menu==12">
        <frm-alumno-materia></frm-alumno-materia>
    </template>

    <template v-if="menu==13">
        <frm-boletin></frm-boletin>
    </template>

    <template v-if="menu==14">
        <frm-usuario></frm-usuario>
    </template>

    <template v-if="menu==15">
        <frm-profesor></frm-profesor>
    </template>
    
    <template v-if="menu==16">
        <frm-secretaria></frm-secretaria>
    </template>

    <template v-if="menu==17">
        <frm-apoderado></frm-apoderado>
    </template>

    <template v-if="menu==18">
        <frm-asistencia></frm-asistencia>
    </template>

@endsection