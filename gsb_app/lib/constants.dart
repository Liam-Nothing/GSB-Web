import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';

class module extends StatelessWidget {
  final String text;
  final String asset;
  final page;
  const module({required this.asset, required this.text, required this.page});
  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(10.0),
      child: OutlinedButton(
          onPressed: () {
            Navigator.push(
                context, MaterialPageRoute(builder: (context) => page));
          },
          child: Column(
            children: [
              Lottie.asset('$asset', frameRate: FrameRate(30)),
              Text(
                text,
                style: kTitreDrawer,
              ),
            ],
          )),
    );
  }
}

const kTitreDrawer = TextStyle(
  color: Colors.black,
  fontWeight: FontWeight.bold,
  fontSize: 40,
);

const kTitreLogin = TextStyle(
  color: Colors.black,
  fontWeight: FontWeight.bold,
  fontSize: 30,
);
