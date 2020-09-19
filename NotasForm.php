<?php
/**
 * NotasForm Master/Detail
 * @author  <your name here>
 */
class NotasForm extends TPage
{
    protected $form; // form
    protected $detail_list;
    
    /**
     * Page constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_Notas');
        $this->form->setFormTitle('Notas');
        
        // master fields
        $id = new TEntry('id');
        $aluno_id = new TDBUniqueSearch('aluno_id', 'cca', 'Aluno', 'id', 'nome');
        $matricula_id = new TDBUniqueSearch('matricula_id', 'cca', 'Matricula', 'id', 'nome_aluno_id');
        $ano_letivo_id = new TDBUniqueSearch('ano_letivo_id', 'cca', 'Matricula', 'id', 'ano_letivo');
        
        $matricula_id->setMinLength(1);
        
        $id->setSize(100);

        // detail fields
        $detail_uniqid = new THidden('detail_uniqid');
        $detail_id = new THidden('detail_id');
        $detail_disciplinas = new TCombo('detail_disciplinas');
        $detail_nota1_primeiro_bi = new TEntry('detail_nota1_primeiro_bi');
        $detail_nota2_primeiro_bi = new TEntry('detail_nota2_primeiro_bi');
        $detail_nota3_primeiro_bi = new TEntry('detail_nota3_primeiro_bi');
        $detail_recuperacao_pri_bi = new TEntry('detail_recuperacao_pri_bi');
        $detail_nota1_segundo_bi = new TEntry('detail_nota1_segundo_bi');
        $detail_nota2_segundo_bi = new TEntry('detail_nota2_segundo_bi');
        $detail_nota3_segundo_bi = new TEntry('detail_nota3_segundo_bi');
        $detail_recuperacao_seg_bi = new TEntry('detail_recuperacao_seg_bi');
        $detail_nota1_terceiro_bi = new TEntry('detail_nota1_terceiro_bi');
        $detail_nota2_terceiro_bi = new TEntry('detail_nota2_terceiro_bi');
        $detail_nota3_terceiro_bi = new TEntry('detail_nota3_terceiro_bi');
        $detail_recuperacao_ter_bi = new TEntry('detail_recuperacao_ter_bi');
        $detail_nota1_quarto_bi = new TEntry('detail_nota1_quarto_bi');
        $detail_nota2_quarto_bi = new TEntry('detail_nota2_quarto_bi');
        $detail_nota3_quarto_bi = new TEntry('detail_nota3_quarto_bi');
        $detail_recuperacao_qua_bi = new TEntry('detail_recuperacao_qua_bi');
        $detail_recuperacao_final = new TEntry('detail_recuperacao_final');
        $detail_media_final = new TEntry('detail_media_final');
        
        // add the combo filds detail_disciplinas

        $detail_disciplinas->addItems(array('Português'=>'Português',
        'Matemática'=>'Matemática',
        'Ciências'=>'Ciências',
        'História'=>'História',
        'Geografia'=>'Geografia',
        'Inglês'=>'Inglês',
        'Arte'=>'Arte',
        'Cidadania'=>'Cidadania',
        'Religião'=>'Religião',
        'Ed. Fídica'=>'Ed. Fídica',
        'Química'=>'Química',
        'Física'=>'Física',
        'Biologia'=>'Biologia',
        'Sociologia'=>'Sociologia',
        'Filosofia'=>'Filosofia',
        'Desenho'=>'Desenho'
        ));

        if (!empty($id))
        {
            $id->setEditable(FALSE);
        }
        
        // master fields
        $this->form->addFields( [new TLabel('Id')], [$id] );
        $this->form->addFields( [new TLabel('Aluno Id')], [$aluno_id] );
        $this->form->addFields( [new TLabel('Matricula Id')], [$matricula_id] );
        $this->form->addFields( [new TLabel('Ano Letivo Id')], [$ano_letivo_id] );
        
        // detail fields
        $this->form->addContent( ['<h4>Details</h4><hr>'] );
        $this->form->addFields( [$detail_uniqid] );
        $this->form->addFields( [$detail_id] );
        
        $this->form->addFields( [new TLabel('Disciplinas')], [$detail_disciplinas] );
        $this->form->addFields( [new TLabel('Nota1 Primeiro Bi')], [$detail_nota1_primeiro_bi] );
        $this->form->addFields( [new TLabel('Nota2 Primeiro Bi')], [$detail_nota2_primeiro_bi] );
        $this->form->addFields( [new TLabel('Nota3 Primeiro Bi')], [$detail_nota3_primeiro_bi] );
        $this->form->addFields( [new TLabel('Recuperacao Pri Bi')], [$detail_recuperacao_pri_bi] );
        $this->form->addFields( [new TLabel('Nota1 Segundo Bi')], [$detail_nota1_segundo_bi] );
        $this->form->addFields( [new TLabel('Nota2 Segundo Bi')], [$detail_nota2_segundo_bi] );
        $this->form->addFields( [new TLabel('Nota3 Segundo Bi')], [$detail_nota3_segundo_bi] );
        $this->form->addFields( [new TLabel('Recuperacao Seg Bi')], [$detail_recuperacao_seg_bi] );
        $this->form->addFields( [new TLabel('Nota1 Terceiro Bi')], [$detail_nota1_terceiro_bi] );
        $this->form->addFields( [new TLabel('Nota2 Terceiro Bi')], [$detail_nota2_terceiro_bi] );
        $this->form->addFields( [new TLabel('Nota3 Terceiro Bi')], [$detail_nota3_terceiro_bi] );
        $this->form->addFields( [new TLabel('Recuperacao Ter Bi')], [$detail_recuperacao_ter_bi] );
        $this->form->addFields( [new TLabel('Nota1 Quarto Bi')], [$detail_nota1_quarto_bi] );
        $this->form->addFields( [new TLabel('Nota2 Quarto Bi')], [$detail_nota2_quarto_bi] );
        $this->form->addFields( [new TLabel('Nota3 Quarto Bi')], [$detail_nota3_quarto_bi] );
        $this->form->addFields( [new TLabel('Recuperacao Qua Bi')], [$detail_recuperacao_qua_bi] );
        $this->form->addFields( [new TLabel('Recuperacao Final')], [$detail_recuperacao_final] );
        $this->form->addFields( [new TLabel('Media Final')], [$detail_media_final] );

        $add = TButton::create('add', [$this, 'onDetailAdd'], 'Register', 'fa:plus-circle green');
        $add->getAction()->setParameter('static','1');
        $this->form->addFields( [], [$add] );
        
        $this->detail_list = new BootstrapDatagridWrapper(new TDataGrid);
        $this->detail_list->setId('NotasItem_list');
        $this->detail_list->generateHiddenFields();
        $this->detail_list->style = "min-width: 700px; width:100%;margin-bottom: 10px";
        
        // items
        $this->detail_list->addColumn( new TDataGridColumn('uniqid', 'Uniqid', 'center') )->setVisibility(false);
        $this->detail_list->addColumn( new TDataGridColumn('id', 'Id', 'center') )->setVisibility(false);
        $this->detail_list->addColumn( new TDataGridColumn('disciplinas', 'Disciplinas', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota1_primeiro_bi', 'Nota1 Primeiro Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota2_primeiro_bi', 'Nota2 Primeiro Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota3_primeiro_bi', 'Nota3 Primeiro Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('recuperacao_pri_bi', 'Recuperacao Pri Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota1_segundo_bi', 'Nota1 Segundo Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota2_segundo_bi', 'Nota2 Segundo Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota3_segundo_bi', 'Nota3 Segundo Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('recuperacao_seg_bi', 'Recuperacao Seg Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota1_terceiro_bi', 'Nota1 Terceiro Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota2_terceiro_bi', 'Nota2 Terceiro Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota3_terceiro_bi', 'Nota3 Terceiro Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('recuperacao_ter_bi', 'Recuperacao Ter Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota1_quarto_bi', 'Nota1 Quarto Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota2_quarto_bi', 'Nota2 Quarto Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('nota3_quarto_bi', 'Nota3 Quarto Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('recuperacao_qua_bi', 'Recuperacao Qua Bi', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('recuperacao_final', 'Recuperacao Final', 'left', 100) );
        $this->detail_list->addColumn( new TDataGridColumn('media_final', 'Media Final', 'left', 100) );

        // detail actions
        $action1 = new TDataGridAction([$this, 'onDetailEdit'] );
        $action1->setFields( ['uniqid', '*'] );
        
        $action2 = new TDataGridAction([$this, 'onDetailDelete']);
        $action2->setField('uniqid');
        
        // add the actions to the datagrid
        $this->detail_list->addAction($action1, _t('Edit'), 'fa:edit blue');
        $this->detail_list->addAction($action2, _t('Delete'), 'far:trash-alt red');
        
        $this->detail_list->createModel();
        
        $panel = new TPanelGroup;
        $panel->add($this->detail_list);
        $panel->getBody()->style = 'overflow-x:auto';
        $this->form->addContent( [$panel] );
        
        $this->form->addAction( 'Save',  new TAction([$this, 'onSave'], ['static'=>'1']), 'fa:save green');
        $this->form->addAction( 'Clear', new TAction([$this, 'onClear']), 'fa:eraser red');
        
        // create the page container
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        parent::add($container);
    }
    
    
    /**
     * Clear form
     * @param $param URL parameters
     */
    public function onClear($param)
    {
        $this->form->clear(TRUE);
    }
    
    /**
     * Add detail item
     * @param $param URL parameters
     */
    public function onDetailAdd( $param )
    {
        try
        {
            $this->form->validate();
            $data = $this->form->getData();
            
            /** validation sample
            if (empty($data->fieldX))
            {
                throw new Exception('The field fieldX is required');
            }
            **/
            
            $uniqid = !empty($data->detail_uniqid) ? $data->detail_uniqid : uniqid();
            
            $grid_data = [];
            $grid_data['uniqid'] = $uniqid;
            $grid_data['id'] = $data->detail_id;
            $grid_data['disciplinas'] = $data->detail_disciplinas;
            $grid_data['nota1_primeiro_bi'] = $data->detail_nota1_primeiro_bi;
            $grid_data['nota2_primeiro_bi'] = $data->detail_nota2_primeiro_bi;
            $grid_data['nota3_primeiro_bi'] = $data->detail_nota3_primeiro_bi;
            $grid_data['recuperacao_pri_bi'] = $data->detail_recuperacao_pri_bi;
            $grid_data['nota1_segundo_bi'] = $data->detail_nota1_segundo_bi;
            $grid_data['nota2_segundo_bi'] = $data->detail_nota2_segundo_bi;
            $grid_data['nota3_segundo_bi'] = $data->detail_nota3_segundo_bi;
            $grid_data['recuperacao_seg_bi'] = $data->detail_recuperacao_seg_bi;
            $grid_data['nota1_terceiro_bi'] = $data->detail_nota1_terceiro_bi;
            $grid_data['nota2_terceiro_bi'] = $data->detail_nota2_terceiro_bi;
            $grid_data['nota3_terceiro_bi'] = $data->detail_nota3_terceiro_bi;
            $grid_data['recuperacao_ter_bi'] = $data->detail_recuperacao_ter_bi;
            $grid_data['nota1_quarto_bi'] = $data->detail_nota1_quarto_bi;
            $grid_data['nota2_quarto_bi'] = $data->detail_nota2_quarto_bi;
            $grid_data['nota3_quarto_bi'] = $data->detail_nota3_quarto_bi;
            $grid_data['recuperacao_qua_bi'] = $data->detail_recuperacao_qua_bi;
            $grid_data['recuperacao_final'] = $data->detail_recuperacao_final;
            $grid_data['media_final'] = $data->detail_media_final;
            
            // insert row dynamically
            $row = $this->detail_list->addItem( (object) $grid_data );
            $row->id = $uniqid;
            
            TDataGrid::replaceRowById('NotasItem_list', $uniqid, $row);
            
            // clear detail form fields
            $data->detail_uniqid = '';
            $data->detail_id = '';
            $data->detail_disciplinas = '';
            $data->detail_nota1_primeiro_bi = '';
            $data->detail_nota2_primeiro_bi = '';
            $data->detail_nota3_primeiro_bi = '';
            $data->detail_recuperacao_pri_bi = '';
            $data->detail_nota1_segundo_bi = '';
            $data->detail_nota2_segundo_bi = '';
            $data->detail_nota3_segundo_bi = '';
            $data->detail_recuperacao_seg_bi = '';
            $data->detail_nota1_terceiro_bi = '';
            $data->detail_nota2_terceiro_bi = '';
            $data->detail_nota3_terceiro_bi = '';
            $data->detail_recuperacao_ter_bi = '';
            $data->detail_nota1_quarto_bi = '';
            $data->detail_nota2_quarto_bi = '';
            $data->detail_nota3_quarto_bi = '';
            $data->detail_recuperacao_qua_bi = '';
            $data->detail_recuperacao_final = '';
            $data->detail_media_final = '';
            
            // send data, do not fire change/exit events
            TForm::sendData( 'form_Notas', $data, false, false );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());
            new TMessage('error', $e->getMessage());
        }
    }
    
    /**
     * Edit detail item
     * @param $param URL parameters
     */
    public static function onDetailEdit( $param )
    {
        $data = new stdClass;
        $data->detail_uniqid = $param['uniqid'];
        $data->detail_id = $param['id'];
        $data->detail_disciplinas = $param['disciplinas'];
        $data->detail_nota1_primeiro_bi = $param['nota1_primeiro_bi'];
        $data->detail_nota2_primeiro_bi = $param['nota2_primeiro_bi'];
        $data->detail_nota3_primeiro_bi = $param['nota3_primeiro_bi'];
        $data->detail_recuperacao_pri_bi = $param['recuperacao_pri_bi'];
        $data->detail_nota1_segundo_bi = $param['nota1_segundo_bi'];
        $data->detail_nota2_segundo_bi = $param['nota2_segundo_bi'];
        $data->detail_nota3_segundo_bi = $param['nota3_segundo_bi'];
        $data->detail_recuperacao_seg_bi = $param['recuperacao_seg_bi'];
        $data->detail_nota1_terceiro_bi = $param['nota1_terceiro_bi'];
        $data->detail_nota2_terceiro_bi = $param['nota2_terceiro_bi'];
        $data->detail_nota3_terceiro_bi = $param['nota3_terceiro_bi'];
        $data->detail_recuperacao_ter_bi = $param['recuperacao_ter_bi'];
        $data->detail_nota1_quarto_bi = $param['nota1_quarto_bi'];
        $data->detail_nota2_quarto_bi = $param['nota2_quarto_bi'];
        $data->detail_nota3_quarto_bi = $param['nota3_quarto_bi'];
        $data->detail_recuperacao_qua_bi = $param['recuperacao_qua_bi'];
        $data->detail_recuperacao_final = $param['recuperacao_final'];
        $data->detail_media_final = $param['media_final'];
        
        // send data, do not fire change/exit events
        TForm::sendData( 'form_Notas', $data, false, false );
    }
    
    /**
     * Delete detail item
     * @param $param URL parameters
     */
    public static function onDetailDelete( $param )
    {
        // clear detail form fields
        $data = new stdClass;
        $data->detail_uniqid = '';
        $data->detail_id = '';
        $data->detail_disciplinas = '';
        $data->detail_nota1_primeiro_bi = '';
        $data->detail_nota2_primeiro_bi = '';
        $data->detail_nota3_primeiro_bi = '';
        $data->detail_recuperacao_pri_bi = '';
        $data->detail_nota1_segundo_bi = '';
        $data->detail_nota2_segundo_bi = '';
        $data->detail_nota3_segundo_bi = '';
        $data->detail_recuperacao_seg_bi = '';
        $data->detail_nota1_terceiro_bi = '';
        $data->detail_nota2_terceiro_bi = '';
        $data->detail_nota3_terceiro_bi = '';
        $data->detail_recuperacao_ter_bi = '';
        $data->detail_nota1_quarto_bi = '';
        $data->detail_nota2_quarto_bi = '';
        $data->detail_nota3_quarto_bi = '';
        $data->detail_recuperacao_qua_bi = '';
        $data->detail_recuperacao_final = '';
        $data->detail_media_final = '';
        
        // send data, do not fire change/exit events
        TForm::sendData( 'form_Notas', $data, false, false );
        
        // remove row
        TDataGrid::removeRowById('NotasItem_list', $param['uniqid']);
    }
    
    /**
     * Load Master/Detail data from database to form
     */
    public function onEdit($param)
    {
        try
        {
            TTransaction::open('cca');
            
            if (isset($param['key']))
            {
                $key = $param['key'];
                
                $object = new Notas($key);
                $items  = NotasItem::where('notas_id', '=', $key)->load();
                
                foreach( $items as $item )
                {
                    $item->uniqid = uniqid();
                    $row = $this->detail_list->addItem( $item );
                    $row->id = $item->uniqid;
                }
                $this->form->setData($object);
                TTransaction::close();
            }
            else
            {
                $this->form->clear(TRUE);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    /**
     * Save the Master/Detail data from form to database
     */
    public function onSave($param)
    {
        try
        {
            // open a transaction with database
            TTransaction::open('cca');
            
            $data = $this->form->getData();
            $this->form->validate();
            
            $master = new Notas;
            $master->fromArray( (array) $data);
            $master->store();
            
            NotasItem::where('notas_id', '=', $master->id)->delete();
            
            if( $param['NotasItem_list_disciplinas'] )
            {
                foreach( $param['NotasItem_list_disciplinas'] as $key => $item_id )
                {
                    $detail = new NotasItem;
                    $detail->disciplinas  = $param['NotasItem_list_disciplinas'][$key];
                    $detail->nota1_primeiro_bi  = $param['NotasItem_list_nota1_primeiro_bi'][$key];
                    $detail->nota2_primeiro_bi  = $param['NotasItem_list_nota2_primeiro_bi'][$key];
                    $detail->nota3_primeiro_bi  = $param['NotasItem_list_nota3_primeiro_bi'][$key];
                    $detail->recuperacao_pri_bi  = $param['NotasItem_list_recuperacao_pri_bi'][$key];
                    $detail->nota1_segundo_bi  = $param['NotasItem_list_nota1_segundo_bi'][$key];
                    $detail->nota2_segundo_bi  = $param['NotasItem_list_nota2_segundo_bi'][$key];
                    $detail->nota3_segundo_bi  = $param['NotasItem_list_nota3_segundo_bi'][$key];
                    $detail->recuperacao_seg_bi  = $param['NotasItem_list_recuperacao_seg_bi'][$key];
                    $detail->nota1_terceiro_bi  = $param['NotasItem_list_nota1_terceiro_bi'][$key];
                    $detail->nota2_terceiro_bi  = $param['NotasItem_list_nota2_terceiro_bi'][$key];
                    $detail->nota3_terceiro_bi  = $param['NotasItem_list_nota3_terceiro_bi'][$key];
                    $detail->recuperacao_ter_bi  = $param['NotasItem_list_recuperacao_ter_bi'][$key];
                    $detail->nota1_quarto_bi  = $param['NotasItem_list_nota1_quarto_bi'][$key];
                    $detail->nota2_quarto_bi  = $param['NotasItem_list_nota2_quarto_bi'][$key];
                    $detail->nota3_quarto_bi  = $param['NotasItem_list_nota3_quarto_bi'][$key];
                    $detail->recuperacao_qua_bi  = $param['NotasItem_list_recuperacao_qua_bi'][$key];
                    $detail->recuperacao_final  = $param['NotasItem_list_recuperacao_final'][$key];
                    $detail->media_final  = $param['NotasItem_list_media_final'][$key];
                    $detail->notas_id = $master->id;
                    $detail->store();
                }
            }
            TTransaction::close(); // close the transaction
            
            TForm::sendData('form_Notas', (object) ['id' => $master->id]);
            
            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'));
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage());
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback();
        }
    }
}
