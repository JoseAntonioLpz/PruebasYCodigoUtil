import QtQuick 2.12
import QtQuick.Window 2.12

Window {
    id: mainWindow
    visible: true
    width: 640
    height: 480
    title: qsTr("Hello World")
    color: "cyan";

    Component.onCompleted: showMaximized();

    Item {
        id: mainItem
        anchors.fill: parent

        Rectangle{
            id: greenRectagle
            anchors.left: parent.left
            anchors.right: parent.right
            anchors.top: parent.verticalCenter
            anchors.bottom: parent.bottom
            color: "green"
        }

        AnimatedSprite {
            id: spriteImage
            source: "images/sprite.jpg"
            frameWidth: 61
            frameHeight: 97
            frameCount: 12
            frameDuration: 75
            frameY : 202
            /*interpolate: false*/
        }
    }
}
