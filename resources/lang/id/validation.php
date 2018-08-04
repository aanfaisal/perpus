<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [

        // buku ==============================================================================        
        'judul'                     => [
            'required'              => 'Kolom JUDUL harus diisi.',
            'max'                   => 'Kolom JUDUL tidak boleh lebih dari :max karakter.',  
        ],

        'id_penulis'                => [
            'required'              => 'Kolom NAMA PENULIS harus diisi.', 
        ],

        'id_penerbit'               => [
            'required'              => 'Kolom NAMA PENERBIT harus diisi.',
        ],

        'id_tahun'                  => [
            'required'              => 'Kolom TAHUN TERBIT harus diisi.',
        ],

        'jumlah'                    => [
            'required'              => 'Kolom JUMLAH harus diisi.',
            'numeric'               => 'Kolom JUMLAH harus diisi angka.', 
        ],

        'deskripsi'                 => [
            'max'                   => 'Kolom DESKRIPSI tidak boleh lebih dari :max karakter.',
        ],

        'cover'                     => [
            'image'                 => 'Kolom COVER harus berupa file gambar.',
            'max'                   => 'Ukuran gambar tidak boleh lebih dari :max karakter.',
            'mimes'                 => 'Format gambar harus jpeg,jpg,bmp,png',
        ],

        // anggota==============================================================================        
        'nis'                       => [
            'required'              => 'Kolom NIS harus diisi.',
            'max'                   => 'Kolom NIS tidak boleh lebih dari :max karakter.',  
        ],

        'nama_anggota'              => [
            'required'              => 'Kolom NAMA ANGGOTA harus diisi.',
            'max'                   => 'Kolom NAMA ANGGOTA tidak boleh lebih dari :max karakter.',  
        ],

        'tgl_lahir'                 => [
            'required'              => 'Kolom TANGGAL LAHIR harus diisi.',
            'date'                  => 'Kolom TANGGAL LAHIR harus format tanggal.',  
        ],

        'jenis_kelamin'             => [
            'required'              => 'Kolom JENIS KELAMIN harus diisi.',
            'in'                    => 'Kolom JENIS KELAMIN harus diisi L atau P.',  
        ],

        'telepon'                   => [
            'numeric'               => 'Kolom TELEPON harus diisi angka.',
            'digits_between'        => 'Kolom TELEPON harus diisi angka antara 10 s/d 15', 
            'unique'                => 'Kolom TELEPON sudah terpakai.', 
        ],

        'alamat'                    => [
            'required'              => 'Kolom ALAMAT harus diisi.',
            'string'                => 'Kolom ALAMAT harus berupa string', 
            'max'                   => 'Kolom ALAMAT tidak boleh lebih dari :max karakter.',
        ],

        'foto1'                     => [
            'image'                 => 'Kolom FOTO harus berupa file gambar.',
            'max'                   => 'Ukuran gambar tidak boleh lebih dari :max karakter.',
            'mimes'                 => 'Format gambar harus jpeg,jpg,bmp,png',
        ],

        // penerbit==============================================================================
        'nm_penerbit'               => [
            'required'              => 'Kolom NAMA PENERBIT harus diisi.',
            'max'                   => 'Kolom NAMA PENERBIT tidak boleh lebih dari :max karakter.',  
        ],

        'tlpn'                      => [
            'numeric'               => 'Kolom TELEPON harus diisi angka.',
            'digits_between'        => 'Kolom TELEPON harus diisi angka antara 10 s/d 15', 
            'unique'                => 'Kolom TELEPON sudah terpakai.', 
        ],

        'alamat'                    => [
            'required'              => 'Kolom ALAMAT harus diisi.',
            'string'                => 'Kolom ALAMAT harus berupa string', 
            'max'                   => 'Kolom ALAMAT tidak boleh lebih dari :max karakter.',
        ],

        // penulis==============================================================================
        'nm_penulis'                => [
            'required'              => 'Kolom NAMA PENULIS harus diisi.',
            'max'                   => 'Kolom NAMA PENULIS tidak boleh lebih dari :max karakter.',  
        ],

        'tlpn'                      => [
            'numeric'               => 'Kolom TELEPON harus diisi angka.',
            'digits_between'        => 'Kolom TELEPON harus diisi angka antara 10 s/d 15', 
            'unique'                => 'Kolom TELEPON sudah terpakai.', 
        ],

        'alamat'                    => [
            'required'              => 'Kolom ALAMAT harus diisi.',
            'string'                => 'Kolom ALAMAT harus berupa string', 
            'max'                   => 'Kolom ALAMAT tidak boleh lebih dari :max karakter.',
        ],

        // tahun terbit==============================================================================
        'tahun'               => [
            'required'              => 'Kolom TAHUN TERBIT harus diisi.',
            'max'                   => 'Kolom TAHUN TERBIT tidak boleh lebih dari :max karakter.',
            'min'                   => 'Kolom TAHUN TERBIT minimal :min karakter.',    
        ],


        // user==============================================================================        
        'name'                      => [
            'required'              => 'Kolom NAMA harus diisi.',
            'max'                   => 'Kolom NAMA tidak boleh lebih dari :max karakter.',  
        ],

        'email'                     => [
            'required'              => 'Kolom EMAIL harus diisi.',
            'email'                 => 'Email tidak valid.',
            'max'                   => 'Kolom EMAIL tidak boleh lebih dari :max karakter.', 
            'unique'                => 'Email sudah terpakai.', 
        ],

        'password'                  => [
            'required'              => 'Kolom PASSWORD harus diisi.',
            'confirmed'             => 'Password tidak sama.', 
            'min'                   => 'Kolom PASSWORD minimal :min karakter.', 
        ],

        'foto'                      => [
            'image'                 => 'Kolom FOTO harus berupa file gambar.',
            'max'                   => 'Ukuran gambar tidak boleh lebih dari :max karakter.',
            'mimes'                 => 'Format gambar harus jpeg,jpg,bmp,png',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
