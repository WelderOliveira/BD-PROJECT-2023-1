<?php

namespace App\Models;

use App\Constantes\Conexoes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

class UsuariosModel extends Model
{
    use HasFactory;

    public static function getUsuario($nome, $senha)
    {
        $query = 'SELECT * FROM tb_user WHERE nome = ? AND senha = ?';

        return DB::select($query, [$nome, $senha]);
    }

    public static function getAllUser()
    {
        $query = 'SELECT * FROM tb_user';
        return DB::select($query);
    }

    /**
     * @param $values
     * @return string
     * @throws Throwable
     */
    public static function createUser($values): string
    {
        $db = DB::connection(Conexoes::DB_PERSISTENCIA);
        $db->beginTransaction();
        try {
            $query = "INSERT INTO tb_user
                        (nome, email, matricula, curso, senha, avatar, tipo_usuario)
                        VALUES (?,?,?,?,?,?,?)";

            $db->statement($query, $values);
            $db->commit();

            return 'Dados inseridos com Sucesso';
        } catch (\Exception $exception) {
            $db->rollBack();
            return $exception->getMessage();
        } catch (Throwable $e) {
            $db->rollBack();
            return $e->getMessage();
        }
    }
}
