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

    /**
     * @param string $email
     * @param string|null $senha
     * @return array
     */
    public static function getUsuario(string $email, string $senha = null): array
    {
        $query = 'SELECT * FROM tb_user WHERE email = ?';
        if (!empty($senha)) {
            $query .= " AND senha = '$senha' LIMIT 1";
        }

        return DB::select($query, [$email]);
    }

    /**
     * @param $id
     * @return array
     */
    public static function getUserById($id): array
    {
        $query = "SELECT * FROM tb_user WHERE id = $id";
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
                        (nome, email, matricula, curso, senha, avatar, admin)
                        VALUES (?,?,?,?,?,?,false)";

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

    /**
     * @param int $id
     * @return string
     * @throws Throwable
     */
    public static function deleteUser(int $id): string
    {
        $db = DB::connection(Conexoes::DB_PERSISTENCIA);
        $db->beginTransaction();
        try {
            $query = 'DELETE FROM tb_user WHERE id = ?';

            $db->statement($query, [$id]);
            $db->commit();

            return 'Usuário excluido com Sucesso';
        } catch (\Exception $exception) {
            $db->rollBack();
            return $exception->getMessage();
        } catch (Throwable $e) {
            $db->rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @param $params
     * @param int $id
     * @return string
     * @throws Throwable
     */
    public static function updateUser($params, int $id): string
    {
        $db = DB::connection(Conexoes::DB_PERSISTENCIA);
        $db->beginTransaction();

        try {
            $setClause = [];
            foreach ($params as $key => $value) {
                $setClause[] = "$key = '$value'";
            }
            $setClauseString = implode(', ', $setClause);

            $query = "UPDATE tb_user SET $setClauseString WHERE id = $id";

            $db->statement($query);
            $db->commit();

            return 'Dados atualizados com Sucesso';
        } catch (\Exception $exception) {
            $db->rollBack();
            return $exception->getMessage();
        } catch (Throwable $e) {
            $db->rollBack();
            return $e->getMessage();
        }
    }
}
