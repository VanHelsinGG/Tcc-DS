<?php 
    /** O arquivo 'settings.php' configura algumas constantes, que consequentemente controlam algumas funções do sistema.
     * Valores:
     * - 0 = desativado
     * - 1 = ativado
     * Versão 08/07/23
     */


    // Informações do projeto
    const PROJECT_NAME                       = "OlympiaWorkout";
    const PROJECT_VERSION                    = "1.0";

    // Configurações gerais
    const ENABLE_PRELOADFILE_ATT_RANKS       = 1;  // Ativa a atualização de ranks no arquivo preload
    const ENABLE_LOG                         = 1;  // Controla o sistema de registros de debug na pasta 'logs'

    date_default_timezone_set('America/Sao_Paulo'); // Seta o fuso-horário do sistema para o brasileiro

?>