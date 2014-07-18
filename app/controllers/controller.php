<?php

class Produtos extends CI_Controller {

    public function __construct() 
    {
        
    }

    public function Index() 
    {
        // sua index 
    }

    public function Mercadopago() 
    {
	// carrega biblioteca pagseguro
	$this->load->library('pagseguro_lib');
	
	// dados do usuário para gerar botão
	$usuario = array(
		'id' =>'id',
		'nome' => 'nome',
		'telefone' => 'tel_celular', // só números
		'email' => 'email@teste.com',
		'shippingType' => 1, //1=Encomenda normal (PAC), 2=SEDEX, 3=Tipo de frete não especificado.
		'cep' => 'end_cep', // só números
		'logradouro' => 'end_endereco',
		'numero' => 'end_numero',
		'compl' => 'end_complemento',
		'bairro' => 'end_bairro',
		'cidade' => 'end_cidade',
		'uf' => 'end_estado',
		'pais' => 'BRA'
	);
	$this->pagseguro->set_user($usuario);

	//carregar as compras 
	foreach ($carrinho AS $rowid => $row) {
		$item = array(
			'id' => $row['id'],
			'descricao' => $row['descricao'],
			'preco' => number_format($row['preco'] + $v = $row['preco'] / 100 * 6.4, 2, '.', ','),
			'qtd' => $row['qtd'],
			'peso' => $row['peso'],
		);
		$product[] = $item;
		$this->pagseguro->set_products($product);
	}
	
	// ID do pedido
	$config['reference'] = rand(999, 9999);
	
	// gera botão nessa tela com os valores
	$data['pagseguro'] = $this->pagseguro->get_button($config);
	$data['total'] = price_format($total);

	$data['titulo'] = 'PagSeguro On-Line';
	$this->load->view('button_pagseguro', $data);
    }
    } 
    else 
    {
        redirect('index'); // em caso de erro ...
    }
    }
  
?>
