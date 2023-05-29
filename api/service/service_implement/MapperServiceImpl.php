<?php
require_once(__DIR__.'../../../model/Usuario.php');
require_once(__DIR__.'../../../model/Mensaje.php');
require_once(__DIR__.'../../../model/DTO/MensajeDTO.php');
require_once(__DIR__.'../../../model/DTO/UsuarioDTO.php');
require_once (__DIR__.'/../MensajeService.php');
require_once(__DIR__.'/../../model/DAO/MensajeDAO.php');
require_once("../../php/funciones.php");
require_once(__DIR__.'../../MapperService.php');


class MapperServiceImpl implements MapperService {


    public function mensajeToDto($mensaje) {

        $usuarioService = new UsuarioServiceImpl(); 

        return (new MensajeDTO(
                            $mensaje->getId(),
                            $mensaje->getIdHilo(),
                            $mensaje->getTexto(),
                            $mensaje->getTitulo(),
                            $mensaje->getFecha(),
                            $usuarioService->findById($mensaje->getIdUsuario())->getNombre()
                            )
                );

    }

    public function usuarioToDto($usuario) {

        $usuarioService = new UsuarioServiceImpl(); 

        return (new UsuarioDTO(
                            $usuario->getId(),
                            $usuario->getNombre(),
                            $usuario->getEmail(),
                            $usuario->getFechaCreacion()
                            )
                );

    }



}