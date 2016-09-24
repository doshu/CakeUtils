<?php

    //all'interno di un controller 
    $table = $this->cell('CountingoperationsTable', [['user' => $this->Auth->user()]]); 
    $table->only_in = $counting->only_in; //le grid possono avere proprie variabili utili a settare la visualizzazione
    $table->setCollection($operations); //imposta la collection da utilizzare
    $table->prepareCollection($operations); //prepare la collection creando le colonne e filtri
    $operations = $this->paginate($operations); //utilizzare paginate sulla collection per effettuare la paginazione
    
    //le migliorie da fare sono:
    //  le row actions dovrebbero essere personalizzabili per riga
