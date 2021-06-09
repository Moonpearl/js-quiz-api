<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $manager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $manager, UserPasswordEncoderInterface  $passwordEncoder)
    {
        $this->manager = $manager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // Create questions
        $question11 = $this->createQuestion('Combien de joueurs y a-t-il dans une équipe de football?',	1);
        $question12 = $this->createQuestion('Combien de temps la lumière du soleil met-elle pour nous parvenir?',	2);
        $question13 = $this->createQuestion('En 1582, le pape Grégoire XIII a décidé de réformer le calendrier instauré par Jules César. Mais quel était le premier mois du calendrier julien?',	3);
        $question14 = $this->createQuestion('Lequel de ces signes du zodiaque n\'est pas un signe d\'Eau?',	4);
        $question15 = $this->createQuestion('Combien de doigts ai-je dans mon dos?',	5);

        // Create answers
        $this->createAnswer('5', $question11);
        $this->createAnswer('7', $question11);
        $question11RightAnswer = $this->createAnswer('11', $question11);
        $this->createAnswer('235', $question11);
        $this->createAnswer('15 secondes', $question12);
        $question12RightAnswer = $this->createAnswer('8 minutes', $question12);
        $this->createAnswer('2 heures', $question12);
        $this->createAnswer('3 mois', $question12);
        $this->createAnswer('Janvier',	$question13);
        $this->createAnswer('Février',	$question13);
        $question13RightAnswer = $this->createAnswer('Mars',	$question13);
        $this->createAnswer('Avril',	$question13);
        $question14RightAnswer = $this->createAnswer('Le Verseau', $question14);
        $this->createAnswer('Le Cancer', $question14);
        $this->createAnswer('Le Scorpion', $question14);
        $this->createAnswer('Les Poissons', $question14);
        $this->createAnswer('2', $question15);
        $this->createAnswer('3', $question15);
        $this->createAnswer('4', $question15);
        $question15RightAnswer = $this->createAnswer('5, comme tout le monde', $question15);

        // Match each question with its right answer
        $question11->setRightAnswer($question11RightAnswer);
        $question12->setRightAnswer($question12RightAnswer);
        $question13->setRightAnswer($question13RightAnswer);
        $question14->setRightAnswer($question14RightAnswer);
        $question15->setRightAnswer($question15RightAnswer);

        $this->manager->flush();
    }

    protected function createQuestion(string $text, int $order): Question
    {
        $question = new Question();
        $question
            ->setText($text)
            ->setOrder($order)
        ;
        $this->manager->persist($question);
        return $question;
    }

    protected function createAnswer(string $text, Question $question): Answer
    {
        $answer = new Answer();
        $answer
            ->setText($text)
            ->setQuestion($question)
        ;
        $this->manager->persist($answer);
        return $answer;
    }
}
