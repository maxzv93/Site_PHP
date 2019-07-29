<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\ShopUser;
use App\Repository\DeviceRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeviceController extends AbstractController
{
    /**
     * @Route("/device", name="device")
     */
    public function index()
    {
        return $this->render('device/index.html.twig', [
            'controller_name' => 'DeviceController',
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN_USER")
     * @Route("/device/create", name="device_create")
     */
    public function createDevice(Request $request)
    {
        $device = new Device();

        $form = $this
            ->createFormBuilder($device)
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Модель устройства',
                'attr' => ['placeholder' => 'Новое устройство']
            ])
            ->add('memory_size', IntegerType::class, [
                'required' => true,
                'label' => 'Обьем памяти телефона, Гб',
                'attr' => ['placeholder' => 'Обьем памяти']
            ])
            ->add('display', TextType::class, [
                'required' => false,
                'label' => 'Размер экрана, в дюймах',
                'attr' => ['placeholder' => '5']
            ])
            ->add('price', MoneyType::class, [
                'required' => true,
                'label' => 'Стоимость телефона, руб',
                'attr' => ['placeholder' => 'Стоимость']
            ])
            ->add('save', SubmitType::class, [
                'label' => "Сохранить"
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $device->setIsDelete(false);//dd($device);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($device);
            $manager->flush();

            return new RedirectResponse('/deviceList');
        }

        return $this->render(
            'device/create.html.twig',
            ["form" => $form->createView()]
        );

        /*        $manager = $this->getDoctrine()->getManager();

                $device = new Device();
                $device->setName("Galaxy A5");
                $device->setMemorySize(16);

                $manager->persist($device);
                $manager->flush();*/


//        return new Response($device->getId());
    }

    /**
     * @Route("/devices/{device}", requirements={"device"="\d+"}, name="device_page")
     * @param Device $device
     * @return Response
     */
    public function getDevice(Device $device)
    {
        //$rep = $this->getDoctrine()->getRepository(Device::class);
        //$device = $rep->find($id);

        return $this->render(
            'device/device.html.twig',
            [
                "device" => $device,
                "user" => $this->getUser()
            ]
        );

    }


    /**
     * @Route("/deviceList",name="device_list")
     */
    public function deviceList()
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository(Device::class);//передаем сущность класса в ре
        $devices = $repository->findBy(["isDelete" => false]);

        return $this->render(
            'device/list.html.twig',
            ["devices" => $devices]
        );
    }


    /**
     * @Route("/device/edit/{device}", requirements={"device"="\d+"}, name="device_edit")
     * @param Device $device
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function deviceEdit(Device $device, Request $request)
    {
        $form = $this
            ->createFormBuilder($device)
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Модель устройства',
                'attr' => ['placeholder' => 'Новое устройство']
            ])
            ->add('memory_size', IntegerType::class, [
                'required' => true,
                'label' => 'Обьем памяти телефона, Гб',
                'attr' => ['placeholder' => 'Обьем памяти']
            ])
            ->add('display', TextType::class, [
                'required' => false,
                'label' => 'Размер экрана, в дюймах',
                'attr' => ['placeholder' => '5']
            ])
            ->add('price', MoneyType::class, [
                'required' => true,
                'label' => 'Стоимость телефона, руб',
                'attr' => ['placeholder' => 'Стоимость']
            ])
            ->add('save', SubmitType::class, [
                'label' => "Сохранить"
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            //dd($device);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($device);
            $manager->flush();
            return new RedirectResponse('/deviceList');
        }

        return $this->render(
            'device/edit.html.twig',
            [
                "form" => $form->createView(),
                "device" => $device
            ]

        );
    }

    /**
     * @Route("/device/edit/{device}/delete", requirements={"device"="\d+"}, name="delete_device", methods={"POST"})
     * @param Device $device
     * @return Response
     */
    public function deleteDevice(Device $device)
    {
        $manager = $this->getDoctrine()->getManager();
        $device->setIsDelete(true);
        $manager->persist($device);
        $manager->flush();

        $arr = ["status" =>"success"];
        return $this->json($arr);
    }

    /**
     * @Route("/devices/{device}.json", requirements={"device"="\d+"}, name="device_page")
     * @param Device $device
     * @return Response
     */
    public function getJsonDevice(Device $device)
    {
        //$rep = $this->getDoctrine()->getRepository(Device::class);
        //$device = $rep->find($id);
        //$res = json_encode($device);
        return $this->json($device);

    }

    /**
     * @Route("/devices/add_to_favourite/{device}", requirements={"device"="\d+"}, name="device_to_favoutite")
     * @param Device $device
     * @return Response
     */
    public function addDeviceToFavourit(Device $device)
    {
        setcookie("favourit", $device->getId(), 60*60*24*365);
        return $this->json(["status" => "success"]);
    }
}
