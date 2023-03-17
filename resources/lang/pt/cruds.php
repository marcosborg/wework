<?php

return [
    'userManagement' => [
        'title'          => 'Gestão de usuários',
        'title_singular' => 'Gestão de usuários',
    ],
    'permission' => [
        'title'          => 'Permissões',
        'title_singular' => 'Permissão',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Grupos',
        'title_singular' => 'Função',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Usuários',
        'title_singular' => 'Usuário',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'company'                  => 'Empresa',
            'company_helper'           => ' ',
            'funnels'                  => 'Funís',
            'funnels_helper'           => ' ',
        ],
    ],
    'company' => [
        'title'          => 'Empresa',
        'title_singular' => 'Empresa',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'vat'               => 'NIPC / NIF',
            'vat_helper'        => ' ',
            'address'           => 'Morada',
            'address_helper'    => ' ',
            'zip'               => 'Código Postal',
            'zip_helper'        => ' ',
            'location'          => 'Localidade',
            'location_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'country'           => 'País',
            'country_helper'    => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'theme'             => 'Template',
            'theme_helper'      => ' ',
            'funnels'           => 'Funís',
            'funnels_helper'    => ' ',
            'logo'              => 'Logo',
            'logo_helper'       => ' ',
        ],
    ],
    'country' => [
        'title'          => 'Países',
        'title_singular' => 'Paíse',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'short_code'        => 'Short Code',
            'short_code_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'state' => [
        'title'          => 'Estados',
        'title_singular' => 'Estado',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'color'             => 'Cor',
            'color_helper'      => ' ',
        ],
    ],
    'funnel' => [
        'title'          => 'Funíl',
        'title_singular' => 'Funíl',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'nome',
            'name_helper'        => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'category'           => 'Categoria',
            'category_helper'    => ' ',
            'description'        => 'Descrição',
            'description_helper' => ' ',
            'file'               => 'Ficheiro',
            'file_helper'        => ' ',
            'message'            => 'Mensagem',
            'message_helper'     => ' ',
        ],
    ],
    'step' => [
        'title'          => 'Passos',
        'title_singular' => 'Passo',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'name'                  => 'Nome',
            'name_helper'           => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'funnel'                => 'Funíl',
            'funnel_helper'         => ' ',
            'state'                 => 'Estado',
            'state_helper'          => ' ',
            'notify_client'         => 'Notificar cliente',
            'notify_client_helper'  => ' ',
            'notify_company'        => 'Notificar empresa',
            'notify_company_helper' => ' ',
            'notify_user'           => 'Notificar utilizador',
            'notify_user_helper'    => ' ',
            'template'              => 'Template',
            'template_helper'       => '{client} {company} {user}',
        ],
    ],
    'category' => [
        'title'          => 'Categorias',
        'title_singular' => 'Categoria',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'management' => [
        'title'          => 'Management',
        'title_singular' => 'Management',
    ],
    'client' => [
        'title'          => 'Cliente',
        'title_singular' => 'Cliente',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'first_name'          => 'First name',
            'first_name_helper'   => ' ',
            'last_name'           => 'Last name',
            'last_name_helper'    => ' ',
            'email'               => 'Email',
            'email_helper'        => ' ',
            'phone'               => 'Phone',
            'phone_helper'        => ' ',
            'website'             => 'Website',
            'website_helper'      => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'company_name'        => 'Nome da empresa',
            'company_name_helper' => ' ',
            'company'             => 'Empresa',
            'company_helper'      => ' ',
        ],
    ],
    'item' => [
        'title'          => 'Iten',
        'title_singular' => 'Iten',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'name'               => 'Nome',
            'name_helper'        => ' ',
            'description'        => 'Descrição',
            'description_helper' => ' ',
            'step'               => 'Passo',
            'step_helper'        => ' ',
            'user'               => 'Utilizador',
            'user_helper'        => ' ',
            'client'             => 'Cliente',
            'client_helper'      => ' ',
            'file'               => 'Ficheiro',
            'file_helper'        => ' ',
        ],
    ],
    'input' => [
        'title'          => 'Entrada',
        'title_singular' => 'Entrada',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Nome',
            'name_helper'        => ' ',
            'description'        => 'Descrição',
            'description_helper' => ' ',
            'item'               => 'Iten',
            'item_helper'        => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'project' => [
        'title'          => 'Projetos',
        'title_singular' => 'Projeto',
    ],
    'district' => [
        'title'          => 'Distritos',
        'title_singular' => 'Distrito',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'form' => [
        'title'          => 'Formulários',
        'title_singular' => 'Formulário',
    ],

];