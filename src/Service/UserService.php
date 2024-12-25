<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UserService
{
    private UserRepository $userRepository;
    private PasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $entityManager;

    public function __construct(UserRepository $userRepository,
                                EntityManagerInterface $entityManager)
    {
        $factory = new PasswordHasherFactory([
            'common' => ['algorithm' => 'bcrypt']
        ]);

        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->passwordHasher = $factory->getPasswordHasher('common');
    }

    public function createUser($email, $password, $username)
    {
//        $users=$this->userRepository->findAll();
////        $this->entityManager->remove($users[0]);
////        $this->entityManager->flush();
//        dump($users);
//        die();
        $user = new User();
        $user->setEmail($email);
        $user->setUsername($username);
        $hashedPassword = $this->passwordHasher->hash(
            $password
        );
        $user->setPassword($hashedPassword);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        dump("Successfully created user");
    }
}