<?

namespace Epost;

class API
{
    const SERVER = "https://api.e-post.com.hk/v4/";

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->gql = new \GQL\Client(self::SERVER . "?token=$token");
    }

    public function createContact(int $contactgroup_id, string $name, string $email = null, string $phone = null)
    {
        return $this->gql->subscription([
            "createContact" => [
                "__args" => [
                    "contactgroup_id" => $contactgroup_id,
                    "name" => $name,
                    "email" => $email,
                    "phone" => $phone
                ]
            ]
        ]);
    }

    public function getContact($contact_id, array $fields)
    {
    }
}
